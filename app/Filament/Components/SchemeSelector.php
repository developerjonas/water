<?php

namespace App\Filament\Components;

use Filament\Forms\Components\Select;
use App\Models\Scheme;
use App\Models\Province;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Donor;

class SchemeSelector
{
    /**
     * Returns a schema array for Filament wizard/form
     *
     * @param string $schemeFieldName The field name for the scheme select
     * @return array
     */
    public static function make(string $schemeFieldName = 'scheme_code'): array
    {
        return [
            Select::make('province')
                ->label('Province')
                ->options(Province::pluck('name', 'province_code'))
                ->reactive()
                ->afterStateUpdated(fn($state, callable $set) => $set('district', null)),

            Select::make('district')
                ->label('District')
                ->options(function (callable $get) {
                    $provinceId = $get('province');
                    return $provinceId ? District::where('province_code', $provinceId)->pluck('name', 'district_code') : [];
                })
                ->reactive()
                ->afterStateUpdated(fn($state, callable $set) => $set('municipality', null)),

            Select::make('municipality')
                ->label('Municipality')
                ->options(function (callable $get) {
                    $districtId = $get('district');
                    return $districtId ? Municipality::where('district_code', $districtId)->pluck('name', 'municipality_code') : [];
                })
                ->reactive(),

            Select::make('donor')
                ->label('Donor')
                ->options(Donor::pluck('name', 'id'))
                ->nullable()
                ->reactive(),

            Select::make($schemeFieldName)
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
                ->helperText('Select the related scheme'),
        ];
    }
}
