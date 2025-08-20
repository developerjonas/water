<?php

namespace App\Filament\Resources\SanitationMetrics\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SanitationMetricInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_code'),
                TextEntry::make('households_total')
                    ->numeric(),
                TextEntry::make('households_with_toilet')
                    ->numeric(),
                TextEntry::make('households_with_drying_rack')
                    ->numeric(),
                TextEntry::make('households_with_handwashing_station')
                    ->numeric(),
                TextEntry::make('households_using_filter')
                    ->numeric(),
                TextEntry::make('households_with_waste_disposal_pit')
                    ->numeric(),
                TextEntry::make('total_sanitation_status'),
                TextEntry::make('remarks'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
