<?php

namespace App\Filament\Resources\FinancialReports\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FinancialReportInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_code'),
                TextEntry::make('helvetas_estimated_cash')
                    ->numeric(),
                TextEntry::make('helvetas_estimated_kd')
                    ->numeric(),
                TextEntry::make('rms_estimated')
                    ->numeric(),
                TextEntry::make('users_estimated')
                    ->numeric(),
                TextEntry::make('others_estimated')
                    ->numeric(),
                TextEntry::make('estimated_total')
                    ->numeric(),
                TextEntry::make('helvetas_actual_cash')
                    ->numeric(),
                TextEntry::make('helvetas_actual_kd')
                    ->numeric(),
                TextEntry::make('rms_actual')
                    ->numeric(),
                TextEntry::make('users_actual')
                    ->numeric(),
                TextEntry::make('others_actual')
                    ->numeric(),
                TextEntry::make('actual_total')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
