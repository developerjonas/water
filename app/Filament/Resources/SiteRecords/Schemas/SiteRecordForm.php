<?php

namespace App\Filament\Resources\SiteRecords\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiteRecordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_code')
                    ->required(),
                TextInput::make('scheme_name'),
                TextInput::make('water_system_name')
                    ->required(),
                TextInput::make('location_type'),
                TextInput::make('water_point_name'),
                TextInput::make('source_details'),
                TextInput::make('hardware_details'),
                TextInput::make('photos'),
                TextInput::make('plaque_photo'),
                TextInput::make('latitude')
                    ->numeric(),
                TextInput::make('longitude')
                    ->numeric(),
            ]);
    }
}
