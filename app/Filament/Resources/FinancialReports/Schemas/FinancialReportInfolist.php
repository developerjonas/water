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
                TextEntry::make('scheme_id')
                    ->numeric(),
                TextEntry::make('district'),
                TextEntry::make('palika'),
                TextEntry::make('sector'),
                TextEntry::make('sub_schemes')
                    ->numeric(),
                TextEntry::make('estimated_total')
                    ->numeric(),
                TextEntry::make('helvetas_actual')
                    ->numeric(),
                TextEntry::make('rms_actual')
                    ->numeric(),
                TextEntry::make('users_actual')
                    ->numeric(),
                TextEntry::make('others_actual')
                    ->numeric(),
                TextEntry::make('actual_expenditure_total')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
