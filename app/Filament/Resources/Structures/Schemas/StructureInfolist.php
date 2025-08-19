<?php

namespace App\Filament\Resources\Structures\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StructureInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_id')
                    ->numeric(),
                TextEntry::make('type'),
                TextEntry::make('estimated')
                    ->numeric(),
                TextEntry::make('achieved')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
