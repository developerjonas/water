<?php

namespace App\Filament\Resources\Schemes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\MultiSelect;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;

class SchemeForm
{
    public static function configure(Schema $schema): Schema
    {
        $provinces = [
            'KAR' => 'Karnali (6)',
            'SUD' => 'Sudurpaschim (7)',
        ];

        $districts = [
            'KAR' => [
                'SUR' => 'Surkhet',
                'DAI' => 'Dailekh',
                'JUM' => 'Jumla',
                'DOL' => 'Dolpa',
                'HUM' => 'Humla',
                'SAL' => 'Salyan',
                'JAJ' => 'Jajarkot',
                'RUK_W' => 'Rukum West',
                'KAL' => 'Kalikot',
                'MUG' => 'Mugu',
            ],
            'SUD' => [
                'BHA' => 'Bajhang',
                'KAI' => 'Kailali',
                'KAN' => 'Kanchanpur',
                'DOT' => 'Doti',
                'DDL' => 'Dadeldhura',
                'BAI' => 'Baitadi',
                'BAJ' => 'Bajura',
                'DAR' => 'Darchula',
                'AAC' => 'Achham',
            ],
        ];

        $municipalities = [
    'SUR' => [
        // Urban Municipalities
        'Birendranagar' => 'Birendranagar Municipality',
        'Gurbhakot' => 'Gurbhakot Municipality',
        'Bheriganga' => 'Bheriganga Municipality',
        'Panchapuri' => 'Panchapuri Municipality',
        'Lekbeshi' => 'Lekbeshi Municipality',

        // Rural Municipalities
        'Chaukune' => 'Chaukune Rural Municipality',
        'Barahatal' => 'Barahatal Rural Municipality',
        'Simta' => 'Simta Rural Municipality',
        'Chingad' => 'Chingad Rural Municipality',
    ],

    'DAI' => [
        // Urban Municipalities
        'ChamundaBindrasaini' => 'Chamunda Bindrasaini Municipality',
        'Dullu' => 'Dullu Municipality',
        'Narayan' => 'Narayan Municipality',

        // Rural Municipalities
        'Gurans' => 'Gurans Rural Municipality',
        'Mahabu' => 'Mahabu Rural Municipality',
        'Naumule' => 'Naumule Rural Municipality',
        'Dungeshwor' => 'Dungeshwor Rural Municipality',
        'Bhagawatimai' => 'Bhagawatimai Rural Municipality',
        'Bhairabi' => 'Bhairabi Rural Municipality',
        'Thantikandh' => 'Thantikandh Rural Municipality',
    ],

    'JUM' => [
        // Urban Municipality
        'Chandannath' => 'Chandannath Municipality',

        // Rural Municipalities
        'Guthichaur' => 'Guthichaur Rural Municipality',
        'Hima' => 'Hima Rural Municipality',
        'Kankasundari' => 'Kankasundari Rural Municipality',
        'Patarasi' => 'Patarasi Rural Municipality',
        'Sinja' => 'Sinja Rural Municipality',
        'Tatopani' => 'Tatopani Rural Municipality',
        'Tila' => 'Tila Rural Municipality',
    ],
];


        return $schema
            ->components([
                Wizard::make([
                    // Step 1: Address
                    Wizard\Step::make('Address')
                        ->schema([
                            Select::make('province')
                                ->label('Province')
                                ->options($provinces)
                                ->reactive()
                                ->required()
                                ->searchable(),

                            Select::make('district')
                                ->label('District')
                                ->options(function ($get) use ($districts) {
                                    $province = $get('province');
                                    return $province ? $districts[$province] ?? [] : [];
                                })
                                ->reactive()
                                ->required()
                                ->searchable(),

                            Select::make('mun')
                                ->label('Municipality / Rural Municipality')
                                ->options(function ($get) use ($municipalities) {
                                    $district = $get('district');
                                    return $district ? $municipalities[$district] ?? [] : [];
                                })
                                ->required()
                                ->searchable(),

                            TextInput::make('ward_no')
                                ->label('Ward Number')
                                ->required()
                                ->numeric(),
                        ]),

                    // Step 2: Scheme Name & Donors
                    Wizard\Step::make('Scheme Info')
                        ->schema([
                            TextInput::make('scheme_name')
                                ->label('Scheme Name')
                                ->required(),

                            MultiSelect::make('donors')
                                ->label('Donors')
                                ->relationship('donors', 'name')
                                ->required(),
                        ]),

                    // Step 3: Other Details
                    Wizard\Step::make('Details')
                        ->schema([
                            Select::make('sector')
                                ->label('Sector')
                                ->options([
                                    'WS' => 'Water Supply',
                                    'SAN' => 'Sanitation'
                                ])
                                ->required(),

                            Select::make('scheme_technology')
                                ->label('Technology')
                                ->options([
                                    'Gravity' => 'Gravity',
                                    'Solar Lift' => 'Solar lift'
                                ]),

                            Select::make('scheme_type')
                                ->label('Scheme Type')
                                ->options([
                                    'New' => 'New',
                                    'Rehab' => 'Rehab'
                                ])
                                ->required(),

                            TextInput::make('scheme_start_year')
                                ->label('Start Year')
                                ->required(),

                            Toggle::make('source_registration_status')
                                ->label('Source Registration')
                                ->required(),

                            TextInput::make('no_subscheme')
                                ->label('Number of Subschemes')
                                ->numeric(),

                            TextInput::make('completed_year')
                                ->label('Completed Year'),
                        ]),

                    // Step 4: Dates & Progress
                    Wizard\Step::make('Dates & Progress')
                        ->schema([
                            DatePicker::make('completion_date')
                                ->label('Completion Date'),

                            Toggle::make('source_conservation')
                                ->label('Source Conservation')
                                ->required(),

                            DatePicker::make('agreement_signed_date'),
                            DatePicker::make('schedule_end_date'),
                            DatePicker::make('started_date'),
                            DatePicker::make('planned_completion_date'),
                            DatePicker::make('actual_completed_date'),

                            Select::make('progress_status')
                                ->label('Progress Status')
                                ->options([
                                    'Completed' => 'Completed',
                                    'Ongoing' => 'Ongoing',
                                    'Dropout' => 'Dropout'
                                ])
                                ->required(),

                            Textarea::make('justification_for_delay')
                                ->label('Justification for Delay')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
