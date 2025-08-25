<?php

namespace App\Filament\Resources\WaterPoints\Schemas;

// use App\Models\Scheme;
use App\Models\SchemeSubSystem;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

use App\Models\Scheme;
use App\Models\Province;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Donor;

class WaterPointForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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

                    Step::make('Water Point Details')
                        ->schema([
                            Section::make('Basic Details')
                                ->schema([
                                    Grid::make(2)->schema([
                                        Select::make('water_system_name')
                                            ->label('Water System Name')
                                            ->required()
                                            ->searchable()
                                            ->options(function ($get) {
                                                $schemeCode = $get('scheme_code');
                                                if (!$schemeCode) return [];
                                                return SchemeSubSystem::where('scheme_code', $schemeCode)
                                                    ->where('is_active', true)
                                                    ->orderBy('sequence')
                                                    ->pluck('name', 'name')
                                                    ->toArray();
                                            }),
                                        TextInput::make('community_name')->columnSpan(1),
                                        TextInput::make('location_type')->columnSpan(1),
                                        TextInput::make('water_point_name')->columnSpan(1),
                                    ]),
                                ]),

                            Section::make('Population & Users')
                                ->schema([
                                    Grid::make(3)->schema([
                                        TextInput::make('hh')->label('Households')->numeric()->default(0),
                                        TextInput::make('taps')->numeric()->default(0),
                                        TextInput::make('population')->numeric()->default(0),
                                        TextInput::make('total_water_users')->numeric()->default(0),
                                        TextInput::make('unique_water_users')->numeric()->default(0),
                                        TextInput::make('schools')->numeric()->default(0),
                                        TextInput::make('students')->numeric()->default(0),
                                        TextInput::make('health_centers')->numeric()->default(0),
                                        TextInput::make('healthposts')->numeric()->default(0),
                                    ]),
                                ]),

                            Section::make('Other Info')
                                ->schema([
                                    Textarea::make('source_details')->columnSpanFull(),
                                    Textarea::make('hardware_details')->columnSpanFull(),
                                    TextInput::make('latitude')->numeric()->placeholder('e.g. 28.3949'),
                                    TextInput::make('longitude')->numeric()->placeholder('e.g. 84.1240'),
                                    TextInput::make('photo_url')->label('Photo URL'),
                                    Textarea::make('remarks')->columnSpanFull(),
                                ]),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
