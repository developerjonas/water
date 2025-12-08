<?php

namespace App\Filament\Resources\Trainings\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get; // Correct namespace for Get
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use App\Models\TrainingType;

class TrainingForm
{
    public static function schema(): array
    {
        // For the training type (level)
        $trainingLevels = TrainingType::query()
            ->where('is_active', true)
            ->distinct('level')
            ->pluck('level', 'level')
            ->filter()
            ->toArray();

        return [
            Group::make()
                ->schema([
                    
                    // --- SECTION 1: MAIN DETAILS ---
                    Section::make('Training Overview')
                        ->description('Basic information about the training event.')
                        ->schema([
                            Grid::make(3)->schema([
                                Select::make('training_type')
                                    ->label('Training Level')
                                    ->options($trainingLevels)
                                    ->searchable()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, $set) {
                                        if (!$state) {
                                            $set('training_name', null);
                                        }
                                    }),

                                Select::make('training_name')
                                    ->label('Training Name')
                                    ->options(function (Get $get) {
                                        $level = $get('training_type');
                                        return TrainingType::query()
                                            ->where('is_active', true)
                                            ->when($level, fn($q) => $q->where('level', $level))
                                            ->orderBy('name')
                                            ->pluck('name', 'id')
                                            ->toArray();
                                    })
                                    ->searchable()
                                    ->required()
                                    ->reactive()
                                    ->columnSpan(2),

                                DatePicker::make('training_start_date'),
                                DatePicker::make('training_end_date'),
                                TextInput::make('training_days')
                                    ->numeric(),

                                TextInput::make('training_place'),
                                TextInput::make('facilitator_name'),
                                TextInput::make('num_schemes_participants')
                                    ->label('No. of Schemes')
                                    ->numeric(),
                                
                                Textarea::make('other')
                                    ->columnSpanFull(),
                            ]),
                        ]),

                    // --- SECTION 2: METRICS & DEMOGRAPHICS ---
                    Section::make('Attendance & Demographics')
                        ->description('Detailed breakdown of participants.')
                        ->collapsible() 
                        ->collapsed(false) // Start open by default
                        ->schema([
                            
                            

                            // Demographics Grid (Dalit, Janjati, Others)
                            Section::make('Ethnicity & Gender Breakdown')
                                ->compact() // Makes it take less space
                                ->schema([
                                    Grid::make(6)->schema([
                                        // Row 1 Labels (implied by grouping)
                                        TextInput::make('dalit_male')->label('Dalit (M)')->numeric(),
                                        TextInput::make('dalit_female')->label('Dalit (F)')->numeric(),
                                        
                                        TextInput::make('janjati_male')->label('Janjati (M)')->numeric(),
                                        TextInput::make('janjati_female')->label('Janjati (F)')->numeric(),

                                        TextInput::make('other_male')->label('Other (M)')->numeric(),
                                        TextInput::make('other_female')->label('Other (F)')->numeric(),
                                    ]),
                                    
                                    // Totals Row
                                    Grid::make(3)->schema([
                                        TextInput::make('male_total')->label('Total Males')->numeric()->readOnly(), 
                                        TextInput::make('female_total')->label('Total Females')->numeric()->readOnly(),
                                        TextInput::make('total')->label('Grand Total')->numeric()->readOnly(),
                                    ]),
                                ]),

                                // Institutional Counts
                            Grid::make(4)
                                ->schema([
                                    TextInput::make('num_participating_schools')->label('Schools')->numeric(),
                                    TextInput::make('teacher_count')->label('Teachers')->numeric(),
                                    TextInput::make('child_club_count')->label('Child Clubs')->numeric(),
                                    TextInput::make('school_mgmt_committee_count')->label('SMC')->numeric(),
                                ]),
                        ]),

                    // --- SECTION 3: PARTICIPANTS REPEATER ---
                    Section::make('Participants List')
                        ->schema([
                            Repeater::make('participants')
                                ->hiddenLabel()
                                ->relationship('participants')
                                ->createItemButtonLabel('Add Participant')
                                ->schema([
                                    Grid::make(4)->schema([
                                        TextInput::make('full_name')->required(),
                                        TextInput::make('address')->required(),
                                        TextInput::make('phone')->tel(),
                                        TextInput::make('school_name')->required(),
                                    ]),
                                    Grid::make(4)->schema([
                                        TextInput::make('teacher')->label('Is Teacher?'), // Suggest changing to Toggle/Checkbox if boolean
                                        TextInput::make('child_club')->label('Child Club Mbr?'),
                                        TextInput::make('school_management_committee')->label('SMC Mbr?'),
                                        TextInput::make('event_name')->label('Event Name'),
                                    ]),
                                ])
                                ->collapsible()
                                ->itemLabel(fn (array $state): ?string => $state['full_name'] ?? null),
                        ]),

                ])->columnSpanFull(),
        ];
    }
}