<?php

namespace App\Filament\Resources\PhotoBanks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;


class PhotoBankForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('water_system_name')
                    ->required(),
                TextInput::make('community_name')
                    ->required(),
                Select::make('location_type')
                    ->options(['Community' => 'Community', 'School' => 'School'])
                    ->required(),
                TextInput::make('water_point_name'),
                TextInput::make('hh_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('taps_count')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('total_users')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('unique_users')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('latitude')
                    ->numeric(),
                TextInput::make('longitude')
                    ->numeric(),
                FileUpload::make('photos')
                    ->multiple()
                    ->image()
                    ->disk('public')              // <- store on public disk
                    ->label('Water Point Photos')
                    ->directory('water_point_photos'),

                // Single plaque photo upload
                FileUpload::make('plaque_photo')
                    ->image()
                    ->disk('public')              // <- store on public disk

                    ->directory('plaque_photos'),
                Textarea::make('remarks')
                    ->columnSpanFull(),
            ]);
    }
}
