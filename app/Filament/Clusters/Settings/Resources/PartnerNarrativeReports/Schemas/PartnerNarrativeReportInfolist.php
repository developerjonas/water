<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PartnerNarrativeReportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('partner_id')
                    ->numeric(),
                TextEntry::make('reporting_period'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
