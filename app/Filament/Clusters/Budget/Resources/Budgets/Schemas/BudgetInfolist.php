<?php

namespace App\Filament\Clusters\Budget\Resources\Budgets\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BudgetInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_code'),
                TextEntry::make('budget_code'),
                TextEntry::make('helvetas_estimated_cash')
                    ->numeric(),
                TextEntry::make('helvetas_estimated_kind')
                    ->numeric(),
                TextEntry::make('helvetas_estimated_total')
                    ->numeric(),
                TextEntry::make('community_contribution')
                    ->numeric(),
                TextEntry::make('palika_estimated')
                    ->numeric(),
                TextEntry::make('total_estimated')
                    ->numeric(),
                TextEntry::make('budget_status'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
