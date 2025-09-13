<?php

namespace App\Filament\Resources\Trainings\Schemas;

use App\Models\Scheme;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use App\Models\TrainingType;
use App\Filament\Components\SchemeSelector;


class TrainingForm
{
    public static function schema(): array
    {

        // For the training type (level)
        $trainingLevels = TrainingType::query()
            ->where('is_active', true)
            ->distinct('level')
            ->pluck('level', 'level')
            ->filter() // removes null levels if any
            ->toArray();

        // For the training name (specific trainings)
        $trainingNames = TrainingType::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();



        return [
            Wizard::make([
                
                Step::make('Training Details')
                    ->description('Provide the training information.')
                    ->schema([
                        Section::make('Training Info')
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
                                            $level = $get('training_type'); // filter by level dynamically
                                            return TrainingType::query()
                                                ->where('is_active', true)
                                                ->when($level, fn($q) => $q->where('level', $level))
                                                ->orderBy('name')
                                                ->pluck('name', 'id')
                                                ->toArray();
                                        })
                                        ->searchable()
                                        ->required()
                                        ->reactive(),
                                    DatePicker::make('training_start_date')
                                        ->columnSpan(1),
                                    DatePicker::make('training_end_date')
                                        ->columnSpan(1),
                                    TextInput::make('training_days')
                                        ->numeric()
                                        ->columnSpan(1),
                                    TextInput::make('training_place')
                                        ->columnSpan(1),
                                    TextInput::make('facilitator_name')
                                        ->columnSpan(1),
                                    TextInput::make('num_participating_schools')
                                        ->numeric()
                                        ->columnSpan(1),
                                    TextInput::make('teacher_count')
                                        ->numeric()
                                        ->columnSpan(1),
                                    TextInput::make('child_club_count')
                                        ->numeric()
                                        ->columnSpan(1),
                                    TextInput::make('school_mgmt_committee_count')
                                        ->numeric()
                                        ->columnSpan(1),
                                    TextInput::make('dalit_male')
                                        ->numeric()
                                        ->columnSpan(1),
                                    TextInput::make('dalit_female')
                                        ->numeric()
                                        ->columnSpan(1),
                                    TextInput::make('janjati_male')
                                        ->numeric()
                                        ->columnSpan(1),
                                    TextInput::make('janjati_female')
                                        ->numeric()
                                        ->columnSpan(1),
                                    TextInput::make('other_male')
                                        ->numeric()
                                        ->columnSpan(1),
                                    TextInput::make('other_female')
                                        ->numeric()
                                        ->columnSpan(1),
                                    TextInput::make('male_total')
                                        ->numeric()
                                        ->columnSpan(1),
                                    TextInput::make('female_total')
                                        ->numeric()
                                        ->columnSpan(1),
                                    TextInput::make('total')
                                        ->numeric()
                                        ->columnSpan(1),
                                    TextInput::make('num_schemes_participants')
                                        ->numeric()
                                        ->columnSpan(1),
                                    Textarea::make('other')
                                        ->columnSpan(1),
                                ]),
                            ]),
                    ]),

                Step::make('Training Participants')
                    ->description('Add participants for this training.')
                    ->schema([
                        Repeater::make('participants')
                            ->label('Participants')
                            ->relationship('participants') // links to your Training->participants() relation
                            ->createItemButtonLabel('Add Participant')
                            ->schema([
                                TextInput::make('full_name')
                                    ->label('Full Name')
                                    ->required(),
                                TextInput::make('address')
                                    ->label('Address')
                                    ->required(),
                                TextInput::make('phone')
                                    ->label('Phone')
                                    ->tel(),
                                TextInput::make('school_name')
                                    ->label('School Name')
                                    ->required(),
                                TextInput::make('teacher')
                                    ->label('Teacher'),
                                TextInput::make('child_club')
                                    ->label('Child Club'),
                                TextInput::make('school_management_committee')
                                    ->label('School Management Committee'),
                                TextInput::make('event_name')
                                    ->label('Name of Event'),
                            ])
                            ->columns(2),
                    ]),
            ])->columnSpanFull(),
        ];
    }
}