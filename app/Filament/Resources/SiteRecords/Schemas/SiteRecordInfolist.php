<?php

namespace App\Filament\Resources\SiteRecords\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

/**
 * Schema for displaying site record information in an infolist format.
 */
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

                TextEntry::make('photos')
                    ->label('Structure Photos')
                    ->formatStateUsing(fn($state) => self::renderImages($state))
                    ->html(),

                TextEntry::make('plaque_photo')
                    ->label('Plaque Photos')
                    ->formatStateUsing(fn($state) => self::renderImages($state))
                    ->html(),

                TextEntry::make('latitude')->numeric(),
                TextEntry::make('longitude')->numeric(),
                TextEntry::make('created_at')->dateTime(),
                TextEntry::make('updated_at')->dateTime(),
            ]);
    }

    protected static function renderImages($state): string
    {
        if (blank($state)) {
            return '<span class="text-gray-500">No images uploaded</span>';
        }

        // Flatten the array and remove any non-string values
        $files = [];
        if (is_array($state)) {
            foreach ($state as $item) {
                if (is_array($item)) {
                    $files = array_merge($files, array_values($item));
                } elseif (is_string($item)) {
                    $files[] = $item;
                }
            }
        } else {
            $files = is_string($state) ? [$state] : json_decode($state, true);
        }

        if (empty($files)) {
            return '<span class="text-gray-500">No images uploaded</span>';
        }

        $html = '<div class="grid grid-cols-3 gap-2">';
        foreach ($files as $file) {
            // Only render if file is string
            if (is_string($file)) {
                $html .= '<img src="' . Storage::url($file) . '" class="w-full h-32 object-cover rounded" />';
            }
        }
        $html .= '</div>';

        return $html;
    }
}
