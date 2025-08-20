<?php

namespace App\Filament\Resources\SiteRecords\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SiteRecordInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_code'),
                TextEntry::make('scheme_name'),
                TextEntry::make('water_system_name'),
                TextEntry::make('location_type'),
                TextEntry::make('water_point_name'),
                TextEntry::make('source_details'),
                TextEntry::make('hardware_details'),
                TextEntry::make('plaque_photo'),
                TextEntry::make('latitude')
                    ->numeric(),
                TextEntry::make('longitude')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
