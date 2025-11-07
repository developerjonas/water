<?php

namespace App\Filament\Components;

use Filament\Forms\Components\Select;
use App\Models\Province;
use App\Models\District;
use App\Models\Municipality;

class LocationSelector
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
                ->options(Province::where('is_active', 1)
                ->pluck('name', 'province_code'))
                ->reactive()
                ->columnSpan(1)
                ->afterStateUpdated(fn($state, callable $set) => $set('district', null)),

            Select::make('district')
                ->label('District')
                ->options(function (callable $get) {
                    $provinceId = $get('province');
                    return $provinceId
                        ? District::where('province_code', $provinceId)
                            ->where('is_active', 1)
                            ->pluck('name', 'district_code')
                        : [];
                })
                ->reactive()
                ->columnSpan(1)
                ->afterStateUpdated(fn($state, callable $set) => $set('municipality', null)),

            Select::make('municipality')
                ->label('Municipality')
                ->options(function (callable $get) {
                    $districtId = $get('district');
                    return $districtId
                        ? Municipality::where('district_code', $districtId)
                            ->where('is_active', 1)
                            ->pluck('name', 'municipality_code')
                        : [];
                })
                ->reactive()
                ->columnSpan(1),
        ];
    }
}
