<?php

namespace App\Filament\Resources\GpsPhotos\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;

class GpsPhotoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                // 1. Scheme Configuration (Matching your Top Section)
                Section::make('Scheme & System Configuration')
                    ->columnSpanFull()
                    ->columns(3)
                    ->schema([
                        // SchemeSelector cannot be used in Infolists (it's for Forms).
                        // Displaying the saved data fields instead:
                        TextEntry::make('scheme_code')
                            ->label('Scheme Code'),
                        
                        TextEntry::make('scheme_name')
                            ->label('Scheme Name')
                            ->placeholder('-'),
                    ]),

                // 2. System Configuration (Matching your Core Info Section)
                Section::make('System Configuration')
                    ->description('Identify the scheme and hardware details.')
                    ->icon('heroicon-m-building-office-2')
                    ->schema([
                        TextEntry::make('water_system_name')
                            ->label('System Name')
                            ->columnSpanFull(),

                        TextEntry::make('location_type')
                            ->badge() // Uses badge style for Select options
                            ->color('gray'),

                        TextEntry::make('source_type')
                            ->badge()
                            ->color('gray'),

                        TextEntry::make('hardware_type')
                            ->badge()
                            ->color('gray')
                            ->columnSpanFull(),
                    ])->columns(2), // Defaults to 2 columns to match form flow

                // 3. Visual Evidence (Matching your Visual Evidence Section)
                Section::make('Visual Evidence')
                    ->icon('heroicon-m-camera')
                    ->collapsible()
                    ->schema([
                        ImageEntry::make('structure_photos')
                            ->label('Structure Photos')
                            ->disk('public')
                            ->columnSpan(1),

                        ImageEntry::make('plaque_photos')
                            ->label('Plaque Photos')
                            ->disk('public')
                            ->columnSpan(1),
                    ])->columns(2),

                // 4. Geolocation (Matching your Geolocation Section)
                Section::make('Geolocation')
                    ->icon('heroicon-m-map-pin')
                    ->schema([
                        TextEntry::make('latitude')
                            ->icon('heroicon-m-globe-alt'),

                        TextEntry::make('longitude')
                            ->icon('heroicon-m-globe-alt'),
                    ])->columns(2),

                // 5. Notes (Matching your Notes Section)
                Section::make('Additional Notes')
                    ->icon('heroicon-m-pencil-square')
                    ->schema([
                        TextEntry::make('remarks')
                            ->placeholder('No remarks provided.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}