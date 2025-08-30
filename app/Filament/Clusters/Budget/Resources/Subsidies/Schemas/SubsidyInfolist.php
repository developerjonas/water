<?php

namespace App\Filament\Clusters\Budget\Resources\Subsidies\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SubsidyInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_code'),
                TextEntry::make('total_estimated')
                    ->numeric(),
                TextEntry::make('helvetas_cash')
                    ->numeric(),
                TextEntry::make('helvetas_kind')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
