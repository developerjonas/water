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
                TextEntry::make('scheme_code'),
                TextEntry::make('audit_type'),
                TextEntry::make('dalit_female')
                    ->numeric(),
                TextEntry::make('dalit_male')
                    ->numeric(),
                TextEntry::make('janjati_female')
                    ->numeric(),
                TextEntry::make('janjati_male')
                    ->numeric(),
                TextEntry::make('other_female')
                    ->numeric(),
                TextEntry::make('other_male')
                    ->numeric(),
                TextEntry::make('total')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
