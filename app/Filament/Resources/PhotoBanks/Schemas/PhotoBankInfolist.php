<?php

namespace App\Filament\Resources\PhotoBanks\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PhotoBankInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('water_system_name'),
                TextEntry::make('community_name'),
                TextEntry::make('location_type'),
                TextEntry::make('water_point_name'),
                TextEntry::make('hh_count')->numeric(),
                TextEntry::make('taps_count')->numeric(),
                TextEntry::make('total_users')->numeric(),
                TextEntry::make('unique_users')->numeric(),
                TextEntry::make('latitude')->numeric(),
                TextEntry::make('longitude')->numeric(),

                // Water Point Photos as a gallery
                TextEntry::make('photos')
                    ->label('Water Point Photos')
                    ->getStateUsing(function ($record) {
                        $html = '<div style="display:flex; flex-wrap:wrap;">';
                        if (!empty($record->photos)) {
                            foreach ($record->photos as $photo) {
                                $url = asset($photo);
                                $html .= '<a href="' . $url . '" target="_blank" style="margin:5px;">
                                            <img src="' . $url . '" style="max-width:120px; border-radius:5px; object-fit:cover;" />
                                          </a>';
                            }
                        }
                        $html .= '</div>';
                        return $html;
                    })
                    ->html(),

                // Plaque Photo
                TextEntry::make('plaque_photo')
                    ->label('Plaque Photo')
                    ->getStateUsing(function ($record) {
                        if ($record->plaque_photo) {
                            $url = asset($record->plaque_photo);
                            return '<img src="' . $url . '" style="max-width:200px; border-radius:5px; object-fit:cover;" />';
                        }
                        return '';
                    })
                    ->html(),

                TextEntry::make('remarks'),
            ]);
    }
}
