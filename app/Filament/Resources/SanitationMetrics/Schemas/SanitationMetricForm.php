<?php

namespace App\Filament\Resources\SanitationMetrics\Schemas;

// use App\Models\Scheme;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Stepper;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;

use App\Models\Scheme;
use App\Models\Province;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Donor;

class SanitationMetricForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make()
                    ->steps([
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

                        Wizard\Step::make('Household Counts')
                            ->schema([
                                TextInput::make('households_total')
                                    ->label('Total Households')
                                    ->default(0)
                                    ->required(),

                                TextInput::make('households_with_toilet')
                                    ->label('Households with Toilet')
                                    ->default(0)
                                    ->required(),

                                TextInput::make('households_with_drying_rack')
                                    ->label('Households with Drying Rack')
                                    ->default(0)
                                    ->required(),

                                TextInput::make('households_with_handwashing_station')
                                    ->label('Households with Handwashing Station')
                                    ->default(0)
                                    ->required(),

                                TextInput::make('households_using_filter')
                                    ->label('Households Using Filter')
                                    ->default(0)
                                    ->required(),

                                TextInput::make('households_with_waste_disposal_pit')
                                    ->label('Households with Waste Disposal Pit')
                                    ->default(0)
                                    ->required(),
                            ]),

                        Wizard\Step::make('Sanitation Status')
                            ->schema([
                                TextInput::make('total_sanitation_status')
                                    ->label('Total Sanitation Declaration Status')
                                    ->placeholder('Yes / No / Partial'),

                                TextInput::make('remarks')
                                    ->label('Remarks')
                                    ->placeholder('Optional notes'),
                            ]),
                    ]),
            ]);
    }
}
