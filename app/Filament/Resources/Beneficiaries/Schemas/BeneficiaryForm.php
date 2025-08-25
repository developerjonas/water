<?php

namespace App\Filament\Resources\Beneficiaries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;



use App\Models\Scheme;
use App\Models\Province;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Donor;

class BeneficiaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    // Step 1: Select Scheme
                    // Step 1: Scheme & Formation
                    Wizard\Step::make('Scheme & Formation')
                        ->schema([
                            Select::make('province')
                                ->label('Province')
                                ->options(Province::pluck('name', 'id'))
                                ->reactive()
                                ->required()
                                ->afterStateUpdated(fn($state, callable $set) => $set('district', null)),

                            Select::make('district')
                                ->label('District')
                                ->options(function (callable $get) {
                                    $provinceId = $get('province');
                                    return $provinceId ? District::where('province_id', $provinceId)->pluck('name', 'id') : [];
                                })
                                ->reactive()
                                ->afterStateUpdated(fn($state, callable $set) => $set('municipality', null))
                                ->required(),

                            Select::make('municipality')
                                ->label('Municipality')
                                ->options(function (callable $get) {
                                    $districtId = $get('district');
                                    return $districtId ? Municipality::where('district_id', $districtId)->pluck('name', 'id') : [];
                                })
                                ->reactive()
                                ->required(),

                            Select::make('donor')
                                ->label('Donor')
                                ->options(Donor::pluck('name', 'id'))
                                ->nullable()
                                ->reactive(),

                            Select::make('scheme_code')
                                ->label('Scheme Code')
                                ->options(function (callable $get) {
                                    $province = $get('province');
                                    $district = $get('district');
                                    $mun = $get('municipality');
                                    $donor = $get('donor');

                                    $query = Scheme::query();

                                    if ($province) $query->where('province', $province);
                                    if ($district) $query->where('district', $district);
                                    if ($mun) $query->where('mun', $mun);
                                    if ($donor) $query->whereJsonContains('collaborator', $donor);

                                    return $query->pluck('scheme_code', 'scheme_code');
                                })
                                ->required()
                                ->searchable()
                                ->placeholder('Select Scheme Code')
                                ->helperText('Select the related scheme for this UC'),
                        ]),

                    // Step 2: Household Beneficiaries
                    Wizard\Step::make('Household Beneficiaries')
                        ->schema([
                            TextInput::make('dalit_hh_poor')
                                ->label('Dalit Poor HH')
                                ->numeric()
                                ->default(0),
                            TextInput::make('dalit_hh_nonpoor')
                                ->label('Dalit Non-Poor HH')
                                ->numeric()
                                ->default(0),
                            TextInput::make('aj_hh_poor')
                                ->label('A/J Poor HH')
                                ->numeric()
                                ->default(0),
                            TextInput::make('aj_hh_nonpoor')
                                ->label('A/J Non-Poor HH')
                                ->numeric()
                                ->default(0),
                            TextInput::make('other_hh_poor')
                                ->label('Other Poor HH')
                                ->numeric()
                                ->default(0),
                            TextInput::make('other_hh_nonpoor')
                                ->label('Other Non-Poor HH')
                                ->numeric()
                                ->default(0),
                        ]),

                    // Step 3: Individual Beneficiaries
                    Wizard\Step::make('Individual Beneficiaries')
                        ->schema([
                            TextInput::make('dalit_female')
                                ->label('Dalit Female')
                                ->numeric()
                                ->default(0),
                            TextInput::make('dalit_male')
                                ->label('Dalit Male')
                                ->numeric()
                                ->default(0),
                            TextInput::make('aj_female')
                                ->label('A/J Female')
                                ->numeric()
                                ->default(0),
                            TextInput::make('aj_male')
                                ->label('A/J Male')
                                ->numeric()
                                ->default(0),
                            TextInput::make('others_female')
                                ->label('Others Female')
                                ->numeric()
                                ->default(0),
                            TextInput::make('others_male')
                                ->label('Others Male')
                                ->numeric()
                                ->default(0),
                        ]),

                    // Step 4: School & Base Population
                    Wizard\Step::make('School / Population')
                        ->schema([
                            TextInput::make('base_population')
                                ->label('Base Population')
                                ->numeric()
                                ->default(0),
                            TextInput::make('boys_student')
                                ->label('Boys Students')
                                ->numeric()
                                ->default(0),
                            TextInput::make('girls_student')
                                ->label('Girls Students')
                                ->numeric()
                                ->default(0),
                            TextInput::make('teachers_staff')
                                ->label('Teachers / Staff')
                                ->numeric()
                                ->default(0),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
