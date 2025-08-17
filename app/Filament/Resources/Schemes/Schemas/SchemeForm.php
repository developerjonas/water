<?php

namespace App\Filament\Resources\Schemes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\MultiSelect;

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
                'Surkhet_M1' => 'Surkhet Municipality 1',
                'Surkhet_M2' => 'Surkhet Municipality 2',
            ],
            'DAI' => [
                'Dailekh_M1' => 'Dailekh Municipality 1',
            ],
            'BHA' => [
                'Bajhang_M1' => 'Bajhang Municipality 1',
            ],
            // etc.
        ];

        return $schema
            ->components([
                Select::make('province')
                    ->label('Province')
                    ->options($provinces)
                    ->reactive() // needed to trigger other dropdowns
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
                    ->required()
                    ->numeric(),

                TextInput::make('scheme_name')
                    ->required(),

                MultiSelect::make('donors')
                    ->label('Donors')
                    ->relationship('donors', 'name') // 'donors' is the Eloquent relationship in Scheme model
                    ->required(),

                Select::make('sector')
                    ->options([
                        'WS' => 'Water Supply',
                        'SAN' => 'Sanitation'
                    ])
                    ->required(),

                Select::make('scheme_technology')
                    ->options([
                        'Gravity' => 'Gravity',
                        'Solar Lift' => 'Solar lift'
                    ]),

                Select::make('scheme_type')
                    ->options([
                        'New' => 'New',
                        'Rehab' => 'Rehab'
                    ])
                    ->required(),

                TextInput::make('scheme_start_year')
                    ->required(),

                Toggle::make('source_registration_status')
                    ->required(),

                TextInput::make('no_subscheme')
                    ->numeric(),

                TextInput::make('completed_year'),

                DatePicker::make('completion_date'),

                Toggle::make('source_conservation')
                    ->required(),

                DatePicker::make('agreement_signed_date'),
                DatePicker::make('schedule_end_date'),
                DatePicker::make('started_date'),
                DatePicker::make('planned_completion_date'),
                DatePicker::make('actual_completed_date'),

                Select::make('progress_status')
                    ->options([
                        'Completed' => 'Completed',
                        'Ongoing' => 'Ongoing',
                        'Dropout' => 'Dropout'
                    ])
                    ->required(),

                Textarea::make('justification_for_delay')
                    ->columnSpanFull(),
            ]);
    }
}