<?php

namespace App\Filament\Resources\InstallmentMonitorings\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InstallmentMonitoringInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_id')
                    ->numeric(),
                TextEntry::make('installment_number'),
                TextEntry::make('installment_date')
                    ->date(),
                TextEntry::make('installment_amount')
                    ->numeric(),
                TextEntry::make('monitoring_type'),
                TextEntry::make('monitoring_date')
                    ->date(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
            ]);
    }
}
