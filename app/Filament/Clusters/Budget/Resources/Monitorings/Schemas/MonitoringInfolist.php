<?php

namespace App\Filament\Clusters\Budget\Resources\Monitorings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MonitoringInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('budget_id')
                    ->numeric(),
                TextEntry::make('file_path'),
                TextEntry::make('monitoring_date')
                    ->date(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
