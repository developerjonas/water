<?php

namespace App\Filament\Resources\WaterPoints\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class WaterPointInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // -------------------
                // Basic References
                // -------------------
                TextEntry::make('scheme_code')->label('Scheme Code'),
                TextEntry::make('water_system_name')->label('Water System / Scheme Name'),
                TextEntry::make('sub_system_name')->label('Water Sub-System / Sub-Scheme Name'),
                TextEntry::make('location_type')->label('Location Type'),
                TextEntry::make('water_point_name')->label('Water Point Name'),

                // -------------------
                // User Counts
                // -------------------
                TextEntry::make('woman')->label('Female Users'),
                TextEntry::make('man')->label('Male Users'),
                TextEntry::make('total_water_users')->label('Total Water Users')->formatStateUsing(fn($state, $record) => $record->woman + $record->man),
                
                // -------------------
                // Tap Construction
                // -------------------
                TextEntry::make('tap_construction_status')->label('Tap Construction Status'),

                // -------------------
                // Remarks / Details
                // -------------------
                TextEntry::make('remarks')->label('Remarks')->wrap(),

                // -------------------
                // Coordinates / Photo
                // -------------------
                TextEntry::make('latitude')->numeric(),
                TextEntry::make('longitude')->numeric(),
                TextEntry::make('photo_url')
                    ->label('Photo')
                    ->formatStateUsing(fn($state) => blank($state) 
                        ? '<span class="text-gray-500">No photo uploaded</span>' 
                        : '<img src="' . Storage::url($state) . '" class="w-32 h-32 object-cover rounded" />'
                    )
                    ->html(),

                // -------------------
                // Timestamps
                // -------------------
                TextEntry::make('created_at')->label('Created At')->dateTime(),
                TextEntry::make('updated_at')->label('Updated At')->dateTime(),
            ]);
    }
}
