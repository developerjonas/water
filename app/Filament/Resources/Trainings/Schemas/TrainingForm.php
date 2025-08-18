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
use Filament\Forms\Components\HasMany;
                    use Filament\Forms\Components\Repeater;

use Closure;


class TrainingForm
{
    public static function schema(): array
    {

        $trainingTypes = [
            'Village Maintenance Workers (VMW)',
            'Mason Training',
            'Refresher Training for Village Maintenance Workers (VMW)',
            'Workshop on Operation and Maintenance of Water Supply Schemes',
            'Municipal-Level Review Workshop on Total Sanitation and Hygiene',
            'Workshop with WASH Entrepreneurs',
            'FCHVs Training',
            'Orientation on Sanitation and Hygiene in Schools of Drinking Water Scheme Coverage Areas',
            'Orientation for WASH in Schools',
            'Sanitation and Hygiene Days Celebration in Schools of Drinking Water Scheme Coverage Areas',
            'Training on Climate Change and 3R Techniques',
            'Orientation Regarding Proper Use and Maintenance of Water Filters',
            'One-Day Orientation on Repair and Maintenance Work Plan of Drinking Water Schemes',
            'Review and Coordination Meeting with Service Providers, Municipalities, and Stakeholders',
            'Training/Seminar for Preparation of Water Use Master Plan and WASH Plan',
            'Water Safety Plan (WSP) Training',
            'Training on WUMP/WASH Plan Approach for Local Organizations',
            'Procurement Training for User Committees',
            'Ward-Level Review Program on Sanitation and Hygiene',
            'Collaboration with Local Stakeholders to Celebrate Sanitation Week',
            'Support to Celebrate Different Days',
            'Public Hearing',
            'Public Review',
            'Final Public Audit',
            'Management Training I',
            'Management Training II',
            'Accounting Management Training',
            'Maintenance, Cleaning, and Hygiene Promotion Training (WASH Trigger)',
            'Conduct Village Hygiene Literacy Class',
            'One-Day Orientation Seminar on Efficient Use of Water and Micro-Irrigation Management',
            'Other',
        ];

        return [
            Wizard::make([
                Step::make('Find Scheme')
                    ->schema([
                        Section::make('Search by Location or Code')
                            ->schema([
                                Grid::make(6)
                                    ->schema([
                                        TextInput::make('province')
                                            ->label('Province')
                                            ->live(onBlur: true)
                                            ->columnSpan(2),
                                        TextInput::make('district')
                                            ->label('District')
                                            ->live(onBlur: true)
                                            ->columnSpan(2),
                                        TextInput::make('mun')
                                            ->label('Municipality')
                                            ->live(onBlur: true)
                                            ->columnSpan(2),
                                        TextInput::make('scheme_code')
                                            ->label('Scheme Code')
                                            ->live(onBlur: true)
                                            ->columnSpanFull(), // full width
                                        Select::make('scheme_id')
                                            ->label('Select Scheme')
                                            ->required()
                                            ->searchable()
                                            ->options(function (Get $get) {
                                                return Scheme::query()
                                                    ->when($get('province'), fn($q, $v) => $q->where('province', 'like', "%{$v}%"))
                                                    ->when($get('district'), fn($q, $v) => $q->where('district', 'like', "%{$v}%"))
                                                    ->when($get('mun'), fn($q, $v) => $q->where('mun', 'like', "%{$v}%"))
                                                    ->when($get('scheme_code'), fn($q, $v) => $q->where('scheme_code', 'like', "%{$v}%"))
                                                    ->orderBy('scheme_name')
                                                    ->limit(50)
                                                    ->pluck('scheme_name', 'id')
                                                    ->toArray();
                                            })
                                            ->placeholder('Start typing filters and pick a scheme')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ]),

                Step::make('Training Details')
                    ->description('Provide the training information.')

                    ->schema([
                        Section::make('Training Info')
                            ->schema([
                                Grid::make(3)->schema([
                                    // Polished training names

                                    // Replace existing training_name field with this:
                                    Select::make('training_type')
                                        ->label('Training Type')
                                        ->options($trainingTypes)
                                        ->searchable()
                                        ->reactive()
                                        ->afterStateUpdated(function ($state, $set) {
                                            if ($state !== 'Other') {
                                                $set('other_training', null);
                                            }
                                        }),

                                    TextInput::make('training_name')
                                        ->label('Specify Other Training')
                                        ->columnSpanFull(),
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
                TextInput::make('number_of_schemes')
                    ->label('Number of Schemes')
                    ->numeric(),
                TextInput::make('event_name')
                    ->label('Name of Event'),
            ])
            ->columns(2),
    ]),

            ])->columnSpanFull(),
        ];
    }
}

