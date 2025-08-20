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
                TextEntry::make('tested_point'),
                TextEntry::make('ecoli')
                    ->numeric(),
                TextEntry::make('coliform')
                    ->numeric(),
                TextEntry::make('ph')
                    ->numeric(),
                TextEntry::make('frc')
                    ->numeric(),
                TextEntry::make('turbidity')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
