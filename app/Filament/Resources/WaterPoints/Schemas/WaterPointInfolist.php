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
                TextEntry::make('scheme_code')->label('Scheme Code'),
                TextEntry::make('district'),
                TextEntry::make('municipality')->label('Municipality'),
                TextEntry::make('ward_no')->numeric()->label('Ward No.'),
                TextEntry::make('water_system_name')->label('Water System Name'),
                TextEntry::make('sub_system')->label('Sub-System'),
                TextEntry::make('community_name')->label('Community Name'),
                TextEntry::make('location_type'),
                TextEntry::make('water_point_name')->label('Water Point Name'),

                TextEntry::make('population_stats')
                    ->label('Population & Users')
                    ->formatStateUsing(fn($state, $record) => 
                        "HH: {$record->hh}, Taps: {$record->taps}, Population: {$record->population}, " .
                        "Total Users: {$record->total_water_users}, Unique Users: {$record->unique_water_users}, " .
                        "Schools: {$record->schools}, Students: {$record->students}, " .
                        "Health Centers: {$record->health_centers}, Healthposts: {$record->healthposts}"
                    )
                    ->html(),

                TextEntry::make('source_details')->label('Source Details'),
                TextEntry::make('hardware_details')->label('Hardware Details'),

                TextEntry::make('photo_url')
                    ->label('Photo')
                    ->formatStateUsing(fn($state) => 
                        blank($state) ? '<span class="text-gray-500">No photo uploaded</span>'
                                      : '<img src="' . Storage::url($state) . '" class="w-32 h-32 object-cover rounded" />'
                    )
                    ->html(),

                TextEntry::make('latitude')->numeric(),
                TextEntry::make('longitude')->numeric(),
                TextEntry::make('remarks')->label('Remarks'),

                TextEntry::make('created_at')->dateTime(),
                TextEntry::make('updated_at')->dateTime(),
            ]);
    }
}
