<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SchemeBudgetMonitoringInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_budget_installment_id')
                    ->numeric(),
                TextEntry::make('description'),
                TextEntry::make('estimated_amount')
                    ->numeric(),
                TextEntry::make('spent_amount')
                    ->numeric(),
                IconEntry::make('verified')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
