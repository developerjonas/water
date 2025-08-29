<?php

namespace App\Filament\Resources\Schemes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use App\Models\Donor;
use App\Models\Province;
use App\Models\District;
use App\Models\Municipality;

class SchemeForm
{
    public static function configure(Schema $schema): Schema
    {
        $provinces = Province::where('is_active', true)->pluck('name', 'province_code')->toArray();

        $donorOptions = Donor::pluck('name', 'id')->toArray();

        return $schema
            ->components([
                Wizard::make([
                    // Step 1: Location / Address
                    Wizard\Step::make('Location / Address')
                        ->schema([
                            Select::make('province')
                                ->label('Province')
                                ->options($provinces)
                                ->reactive()
                                ->required()
                                ->searchable(),

                            Select::make('district')
                                ->label('District')
                                ->options(
                                    fn($get) => $get('province')
                                    ? District::where('province_code', $get('province'))
                                        ->where('is_active', true)
                                        ->pluck('name', 'district_code')
                                        ->toArray()
                                    : []
                                )
                                ->reactive()
                                ->required()
                                ->searchable(),

                            Select::make('mun')
                                ->label('Municipality / Rural Municipality')
                                ->options(
                                    fn($get) => $get('district')
                                    ? Municipality::where('district_code', $get('district'))
                                        ->where('is_active', true)
                                        ->pluck('name', 'municipality_code')
                                        ->toArray()
                                    : []
                                )
                                ->required()
                                ->searchable(),

                            TextInput::make('ward_no')
                                ->label('Ward Number')
                                ->numeric()
                                ->required(),
                        ]),

                    // Step 2: Identification
                    Wizard\Step::make('Identification')
                        ->schema([
                            TextInput::make('scheme_name')
                                ->label('Scheme Name (EN)')
                                ->required(),
                            TextInput::make('scheme_name_np')
                                ->label('Scheme Name (NP)'),
                        ]),

                    // Step 3: Type & Classification
                    Wizard\Step::make('Type & Classification')
                        ->schema([
                            Select::make('sector')
                                ->label('Sector')
                                ->options([
                                    'WS' => 'Water Supply',
                                    'SAN' => 'Sanitation',
                                ])
                                ->searchable()
                                ->nullable(),
                            Select::make('scheme_technology')
                                ->label('Scheme Technology')
                                ->options([
                                    'WS' => 'Gravity',
                                    'SAN' => 'Solar Lift',
                                ])
                                ->searchable()
                                ->nullable(),

                            Select::make('scheme_type')
                                ->label('Scheme Type')
                                ->options([
                                    'DWS' => 'DWS',
                                    'MUS' => 'MUS',
                                ])
                                ->default('DWS')
                                ->required(),
                            Select::make('scheme_construction_type')
                                ->label('Construction Type')
                                ->options([
                                    'New' => 'New',
                                    'Rehab' => 'Rehab',
                                ])
                                ->default('New')
                                ->required(),
                        ]),

                    // Step 4: Timing & Dates
                    Wizard\Step::make('Timing & Dates')
                        ->schema([
                            TextInput::make('scheme_start_year')
                                ->label('Start Year')
                                ->numeric()
                                ->required()
                                ->columnSpan(2),

                            DatePicker::make('agreement_signed_date')
                                ->label('Agreement Signed Date')
                                ->columnSpan(1),
                            DatePicker::make('agreement_end_date')
                                ->label('Agreement End Date')
                                ->columnSpan(1),

                            DatePicker::make('started_date')
                                ->label('Start Date of Construction')
                                ->columnSpan(1),

                            DatePicker::make('planned_completion_date')
                                ->label('Planned Completion Date')
                                ->columnSpan(1),

                            DatePicker::make('appendment_date')
                                ->label('Appendment Date')
                                ->columnSpan(1),

                            DatePicker::make('actual_completed_date')
                                ->label('Actual Completion Date')
                                ->columnSpan(1),






                        ])
                        ->columns(2), // 2 columns grid layout


                    // Step 5: Contributors
                    Wizard\Step::make('Contributors')
                        ->schema([
                            Select::make('collaborator')
                                ->label('Select Donor(s)')
                                ->options($donorOptions)
                                ->multiple()
                                ->searchable()
                                ->required(),
                        ]),

                    // Step 6: Status Flags
                    Wizard\Step::make('Status')
                        ->schema([
                            Toggle::make('source_registration_status')
                                ->label('Source Registration')
                                ->required(),
                            Toggle::make('source_conservation')
                                ->label('Source Conservation')
                                ->required(),
                            Toggle::make('no_subscheme')
                                ->label('No Subscheme')
                                ->required(),
                            Select::make('progress_status')
                                ->label('Construction Type')
                                ->options([
                                    'Completed' => 'Completed',
                                    'Ongoing' => 'Ongoing',
                                    'Dropout' => 'Dropout',
                                ])
                                ->default('New')
                                ->required(),
                            Textarea::make('justification_for_delay')
                                ->label('Justification for Delay')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
