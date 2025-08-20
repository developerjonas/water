<?php

namespace App\Filament\Resources\WaterQualityTests\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class WaterQualityTestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_code'),
                TextEntry::make('water_quality_tested_point_name'),
                TextEntry::make('e_coli')
                    ->numeric(),
                TextEntry::make('coliform')
                    ->numeric(),
                TextEntry::make('ph')
                    ->numeric(),
                TextEntry::make('frc')
                    ->numeric(),
                TextEntry::make('turbidity')
                    ->numeric(),
                TextEntry::make('e_coli_risk_category'),
                TextEntry::make('e_coli_risk_zone'),
                TextEntry::make('coliform_risk_category'),
                TextEntry::make('coliform_risk_zone'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
            ]);
    }
}
