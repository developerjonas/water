<?php

namespace App\Filament\Resources\GpsPhotos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

class GpsPhotoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_code'),
                TextEntry::make('scheme_name'),
                TextEntry::make('water_system_name'),
                TextEntry::make('location_type'),
                TextEntry::make('source_type'),
                TextEntry::make('hardware_type'),

                TextEntry::make('structure_photos')
                    ->label('Structure Photos')
                    ->formatStateUsing(fn($state) => self::renderImages($state))
                    ->html(),

                TextEntry::make('plaque_photos')
                    ->label('Plaque Photos')
                    ->formatStateUsing(fn($state) => self::renderImages($state))
                    ->html(),

                TextEntry::make('latitude')->numeric(),
                TextEntry::make('longitude')->numeric(),
                TextEntry::make('remarks'),
                TextEntry::make('created_at')->dateTime(),
                TextEntry::make('updated_at')->dateTime(),
            ]);
    }

    protected static function renderImages($state): string
    {
        if (blank($state)) {
            return '<span class="text-gray-500">No images uploaded</span>';
        }

        $files = is_array($state) ? $state : json_decode($state, true);

        if (empty($files)) {
            return '<span class="text-gray-500">No images uploaded</span>';
        }

        $html = '<div class="grid grid-cols-3 gap-2">';
        foreach ($files as $file) {
            if (is_string($file)) {
                $html .= '<img src="' . Storage::url($file) . '" class="w-full h-32 object-cover rounded" />';
            }
        }
        $html .= '</div>';

        return $html;
    }
}
