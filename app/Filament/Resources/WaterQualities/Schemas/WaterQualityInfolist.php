<?php

namespace App\Filament\Resources\WaterQualities\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class WaterQualityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_id')
                    ->numeric(),
                TextEntry::make('district'),
                TextEntry::make('r_m_palika'),
                TextEntry::make('tested_point'),
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
                TextEntry::make('e_coli_percentage')
                    ->numeric(),
                TextEntry::make('e_coli_risk_zone'),
                TextEntry::make('coliform_risk_category'),
                TextEntry::make('coliform_percentage')
                    ->numeric(),
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
