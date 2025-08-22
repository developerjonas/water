<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SchemeBudgetSettlementInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_budget_monitoring_id')
                    ->numeric(),
                TextEntry::make('settled_amount')
                    ->numeric(),
                IconEntry::make('approved')
                    ->boolean(),
                IconEntry::make('recovered')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
