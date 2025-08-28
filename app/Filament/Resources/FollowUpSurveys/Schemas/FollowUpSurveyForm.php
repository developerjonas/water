<?php

namespace App\Filament\Resources\FollowUpSurveys\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use App\Filament\Components\SchemeSelector;

class FollowUpSurveyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Wizard::make([
                // Step 1 – Scheme selection only
                Step::make('Scheme & Formation')
                    ->schema(SchemeSelector::make()),

                // Step 2 – Survey & Enumerator Details
                Step::make('Survey Details')
                    ->schema([
                        Section::make('Enumerator & Respondent')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('follow_up_type')->required(),
                                        DatePicker::make('follow_up_date')->required(),
                                        TextInput::make('enumerator_name')->required(),
                                        TextInput::make('key_respondent_name')->required(),
                                        TextInput::make('key_respondent_position')->required(),
                                        TextInput::make('key_respondent_contact'),
                                        TextInput::make('wusc_official_name')->required(),
                                    ]),
                            ]),
                    ])
                    ->icon('heroicon-m-user-group'),

                // Step 3 – Coverage & Functionality
                Step::make('Project Coverage')
                    ->schema([
                        Section::make('Coverage Metrics')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('total_households')->required()->numeric(),
                                        TextInput::make('total_taps')->required()->numeric(),
                                        TextInput::make('functional_taps')->numeric()->default(0),
                                        TextInput::make('non_functional_taps_closure')->numeric()->default(0),
                                        TextInput::make('non_functional_taps_no_water')->numeric()->default(0),
                                    ]),
                                Textarea::make('reasons_non_functionality')->columnSpanFull(),
                                Toggle::make('is_mus')->label('Multiple Use System?')->required(),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('households_with_kitchen_gardens')->numeric()->default(0),
                                        TextInput::make('avg_kitchen_garden_size')->numeric()->label('Avg. Garden Size (ropani)'),
                                    ]),
                            ]),
                    ])
                    ->icon('heroicon-m-user-group'),

                // Step 4 – WUSC Information
                Step::make('WUSC Info')
                    ->schema([
                        Section::make('Composition & Officials')
                            ->schema([
                                Grid::make(4)
                                    ->schema([
                                        Toggle::make('is_wusc')->label('WUSC Exists?')->required(),
                                        TextInput::make('total_wusc_officials')->numeric()->default(0),
                                        TextInput::make('female_officials')->numeric()->default(0),
                                        TextInput::make('dalit_officials')->numeric()->default(0),
                                        TextInput::make('janajati_officials')->numeric()->default(0),
                                    ]),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('wusc_chairperson_name'),
                                        TextInput::make('wusc_chairperson_contact'),
                                        TextInput::make('wusc_vice_chairperson_name'),
                                        TextInput::make('wusc_vice_chairperson_contact'),
                                        TextInput::make('wusc_secretary_name'),
                                        TextInput::make('wusc_secretary_contact'),
                                        TextInput::make('wusc_treasurer_name'),
                                        TextInput::make('wusc_treasurer_contact'),
                                    ]),
                            ]),
                    ])
                    ->icon('heroicon-m-user-group'),

                // Step 5 – Caretaker Info
                Step::make('Caretaker')
                    ->schema([
                        Section::make('Caretaker Details')
                            ->schema([
                                Toggle::make('is_caretaker')->label('Caretaker Mobilized?')->required(),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('caretaker_name'),
                                        TextInput::make('caretaker_contact'),
                                    ]),
                                Grid::make(2)
                                    ->schema([
                                        Toggle::make('caretaker_regular')->label('Regular Worker?')->required(),
                                        Toggle::make('caretaker_trained')->label('Trained?')->required(),
                                        Toggle::make('caretaker_paid')->label('Receiving Honorarium?')->required(),
                                        TextInput::make('caretaker_honorarium')->numeric()->label('Monthly Honorarium'),
                                    ]),
                            ]),
                    ])
                    ->icon('heroicon-m-user-circle'),

                // Step 6 – Governance & Meetings
                Step::make('Governance')
                    ->schema([
                        Section::make('Registration & Assemblies')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Toggle::make('is_wusc_registered')->label('Registered?')->required(),
                                        TextInput::make('registration_number'),
                                        Toggle::make('ag_assembly_regular')->label('AG Assembly Regular?')->required(),
                                        DatePicker::make('last_general_assembly_date'),
                                        Toggle::make('meetings_regular')->label('Meetings Regular?')->required(),
                                        TextInput::make('meeting_frequency'),
                                        TextInput::make('meetings_last_year')->numeric()->default(0),
                                        Toggle::make('wusc_reformed')->label('Reformed Post-Completion?')->required(),
                                        TextInput::make('record_minutes'),
                                        TextInput::make('record_income_expense'),
                                    ]),
                            ]),
                    ])
                    ->icon('heroicon-m-document-check'),

                // Step 7 – O&M & Infrastructure
                Step::make('O&M & Infrastructure')
                    ->schema([
                        Section::make('O&M Plan & Funds')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Toggle::make('has_om_plan')->label('Has O&M Plan?')->required(),
                                        Toggle::make('fund_collection_regular')->label('Fund Collection Regular?')->required(),
                                        TextInput::make('monthly_tariff')->numeric()->label('Monthly Tariff (NRs.)'),
                                        TextInput::make('total_om_fund')->numeric()->label('Total O&M Fund (NRs.)'),
                                    ]),
                            ]),
                        Section::make('Infrastructure Status')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('status_intake'),
                                        TextInput::make('status_pipeline'),
                                        TextInput::make('status_rvt'),
                                        TextInput::make('status_tap_stands'),
                                        TextInput::make('status_other_structures'),
                                    ]),
                            ]),
                    ])
                    ->icon('heroicon-m-wrench'),

                // Step 8 – Photos, Observations & GPS
                Step::make('Observations')
                    ->schema([
                        Section::make('Visual & Comments')
                            ->schema([
                                TextInput::make('photo_1')->label('Photo URL / Path 1'),
                                TextInput::make('photo_2')->label('Photo URL / Path 2'),
                                Textarea::make('major_problems')->columnSpanFull(),
                                Textarea::make('enumerator_suggestions')->columnSpanFull(),
                                Textarea::make('improvements_done')->columnSpanFull(),
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('latitude')->numeric(),
                                        TextInput::make('longitude')->numeric(),
                                    ]),
                            ]),
                    ])
                    ->icon('heroicon-m-wrench'),
            ])
                ->skippable()
                ->persistStepInQueryString()
                ->columnSpanFull(),
        ]);
    }
}
