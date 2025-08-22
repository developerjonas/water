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

class SchemeForm
{
    public static function configure(Schema $schema): Schema
    {
        // Provinces
        $provinces = [
            'KAR' => 'Karnali (6)',
            'SUD' => 'Sudurpashchim (7)',
        ];

        // Districts
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

        // Municipalities / Rural Municipalities
        $municipalities = [
            'SUR' => ['Birendranagar' => 'Birendranagar Municipality', 'Gurbhakot' => 'Gurbhakot Municipality', 'Bheriganga' => 'Bheriganga Municipality'],
            'DAI' => ['ChamundaBindrasaini' => 'Chamunda Bindrasaini Municipality', 'Dullu' => 'Dullu Municipality', 'Narayan' => 'Narayan Municipality'],
            'JUM' => ['Chandannath' => 'Chandannath Municipality', 'Guthichaur' => 'Guthichaur Rural Municipality', 'Hima' => 'Hima Rural Municipality'],
            'DOL' => ['ThuliBheri' => 'Thuli Bheri Municipality', 'Dolpa' => 'Dolpa Rural Municipality'],
            'HUM' => ['Simkot' => 'Simkot Municipality', 'Namkha' => 'Namkha Rural Municipality'],
            'SAL' => ['Salyan' => 'Salyan Municipality', 'Bagchaur' => 'Bagchaur Rural Municipality'],
            'JAJ' => ['Chhedagad' => 'Chhedagad Municipality', 'Kandel' => 'Kandel Rural Municipality'],
            'RUK_W' => ['Music' => 'Musikot Municipality', 'Rukum' => 'Rukum Rural Municipality'],
            'KAL' => ['Kalikot' => 'Kalikot Municipality', 'Palata' => 'Palata Rural Municipality'],
            'MUG' => ['Mugu' => 'Mugu Municipality', 'Soru' => 'Soru Rural Municipality'],
            'BHA' => ['Bajhang' => 'Bajhang Municipality', 'JayaPrithvi' => 'Jaya Prithvi Rural Municipality'],
            'KAI' => ['Dhangadhi' => 'Dhangadhi Municipality', 'Lamkichuha' => 'Lamkichuha Municipality'],
            'KAN' => ['Mahakali' => 'Mahakali Municipality', 'Panchadewal' => 'Panchadewal Rural Municipality'],
            'DOT' => ['Doti' => 'Doti Municipality', 'Shikhar' => 'Shikhar Rural Municipality'],
            'DDL' => ['Dadeldhura' => 'Dadeldhura Municipality', 'Alital' => 'Alital Rural Municipality'],
            'BAI' => ['Baitadi' => 'Baitadi Municipality', 'Melauli' => 'Melauli Rural Municipality'],
            'BAJ' => ['Bajura' => 'Bajura Municipality', 'Budhiganga' => 'Budhiganga Rural Municipality'],
            'DAR' => ['Darchula' => 'Darchula Municipality', 'Api' => 'Api Rural Municipality'],
            'AAC' => ['Mangalsen' => 'Mangalsen Municipality', 'Kamalbazar' => 'Kamalbazar Municipality'],
        ];
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
                                ->options(fn($get) => $get('province') ? $districts[$get('province')] ?? [] : [])
                                ->reactive()
                                ->required()
                                ->searchable(),
                            Select::make('mun')
                                ->label('Municipality / Rural Municipality')
                                ->options(fn($get) => $get('district') ? $municipalities[$get('district')] ?? [] : [])
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
                            TextInput::make('scheme_technology')
                                ->label('Technology')
                                ->nullable(),
                            Select::make('scheme_type')
                                ->label('Scheme Type')
                                ->options([
                                    'DWS' => 'DWS',
                                    'MUS' => 'MUS',
                                    'New' => 'New',
                                    'Rehab' => 'Rehab',
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
                                ->required(),
                            DatePicker::make('completion_date')
                                ->label('Expected Completion Date'),
                            DatePicker::make('agreement_signed_date')
                                ->label('Agreement Signed Date'),
                            DatePicker::make('schedule_end_date')
                                ->label('Scheduled End Date'),
                            DatePicker::make('started_date')
                                ->label('Start Date of Construction'),
                            DatePicker::make('planned_completion_date')
                                ->label('Planned Completion Date'),
                            DatePicker::make('actual_completed_date')
                                ->label('Actual Completion Date'),
                        ]),

                    Wizard\Step::make('Contributors')
                        ->schema([
                            Select::make('collaborator')
                                ->label('Select Donor(s)')
                                ->options($donorOptions)
                                ->multiple()
                                ->searchable()
                                ->required(),
                        ]),

                    // Step 5: Status Flags
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
                            TextInput::make('progress_status')
                                ->label('Progress Status')
                                ->nullable(),
                            Textarea::make('justification_for_delay')
                                ->label('Justification for Delay')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
