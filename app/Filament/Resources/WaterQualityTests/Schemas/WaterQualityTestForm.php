<?php

namespace App\Filament\Resources\WaterQualityTests\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
// use App\Models\Scheme;
use App\Models\WaterPoint;

use App\Models\Scheme;
use App\Models\Province;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Donor;

class WaterQualityTestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Wizard::make([
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

                                if ($province)
                                    $query->where('province', $province);
                                if ($district)
                                    $query->where('district', $district);
                                if ($mun)
                                    $query->where('mun', $mun);
                                if ($donor)
                                    $query->whereJsonContains('collaborator', $donor);

                                return $query->pluck('scheme_code', 'scheme_code');
                            })
                            ->required()
                            ->searchable()
                            ->placeholder('Select Scheme Code')
                            ->helperText('Select the related scheme for this UC'),


                        // 2️⃣ Water Point select
                        Select::make('water_point_id')
                            ->label('Tested Point')
                            ->options(function ($get) {
                                $schemeCode = $get('scheme_code');
                                if (!$schemeCode) {
                                    return [];
                                }

                                return WaterPoint::where('scheme_code', $schemeCode)
                                    ->whereNotNull('water_system_name')
                                    ->pluck('water_system_name', 'id')
                                    ->toArray();
                            })
                            ->required()
                            ->reactive()
                            ->placeholder('Select a water point'),
                    ]),

                Step::make('Measurements')
                    ->schema([
                        TextInput::make('ecoli')
                            ->label('E.coli (CFU/100ml)')
                            ->numeric()
                            ->default(0),
                        TextInput::make('coliform')
                            ->label('Coliform (CFU/100ml)')
                            ->numeric()
                            ->default(0),
                        TextInput::make('ph')
                            ->label('pH')
                            ->numeric()
                            ->default(7.0),
                        TextInput::make('frc')
                            ->label('FRC (mg/L)')
                            ->numeric()
                            ->default(0),
                        TextInput::make('turbidity')
                            ->label('Turbidity (NTU)')
                            ->numeric()
                            ->default(0),
                    ]),

                Step::make('Remarks')
                    ->schema([
                        Textarea::make('remarks')
                            ->label('Remarks')
                            ->columnSpanFull(),
                    ]),
            ]),
        ]);
    }
}
