<?php

namespace App\Filament\Resources\WaterPoints\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class WaterPointInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_id')
                    ->numeric(),
                TextEntry::make('district'),
                TextEntry::make('palika'),
                TextEntry::make('water_system_name'),
                TextEntry::make('location_type'),
                TextEntry::make('water_point_name'),
                TextEntry::make('latitude')
                    ->numeric(),
                TextEntry::make('longitude')
                    ->numeric(),
                TextEntry::make('photo_url'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
