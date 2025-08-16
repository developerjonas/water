<?php

namespace App\Filament\Resources\WaterPoints\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class WaterPointForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_id')
                    ->required()
                    ->numeric(),
                TextInput::make('district'),
                TextInput::make('palika'),
                TextInput::make('water_system_name'),
                TextInput::make('location_type'),
                TextInput::make('water_point_name'),
                Textarea::make('source_details')
                    ->columnSpanFull(),
                Textarea::make('hardware_details')
                    ->columnSpanFull(),
                TextInput::make('latitude')
                    ->numeric(),
                TextInput::make('longitude')
                    ->numeric(),
                TextInput::make('photo_url'),
            ]);
    }
}
