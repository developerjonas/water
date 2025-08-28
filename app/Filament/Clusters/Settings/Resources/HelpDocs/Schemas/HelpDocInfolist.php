<?php

namespace App\Filament\Clusters\Settings\Resources\HelpDocs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HelpDocInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title'),
                TextEntry::make('file_path'),
                TextEntry::make('file_type'),
                TextEntry::make('category'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
