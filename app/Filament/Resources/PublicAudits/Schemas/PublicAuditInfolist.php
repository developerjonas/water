<?php

namespace App\Filament\Resources\PublicAudits\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PublicAuditInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_id')
                    ->numeric(),
                TextEntry::make('district'),
                TextEntry::make('palika'),
                TextEntry::make('donor'),
                TextEntry::make('scheme_start_year'),
                TextEntry::make('scheme_name'),
                TextEntry::make('audit_name'),
                TextEntry::make('audit_date')
                    ->date(),
                TextEntry::make('df')
                    ->numeric(),
                TextEntry::make('dm')
                    ->numeric(),
                TextEntry::make('jf')
                    ->numeric(),
                TextEntry::make('jm')
                    ->numeric(),
                TextEntry::make('of')
                    ->numeric(),
                TextEntry::make('om')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
