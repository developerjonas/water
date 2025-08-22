<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SchemeBudgetInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_code')
                    ->numeric(),
                TextEntry::make('sub_schemes'),
                TextEntry::make('estimated_amount')
                    ->numeric(),
                TextEntry::make('estimated_helvetas_cash')
                    ->numeric(),
                TextEntry::make('estimated_helvetas_kd')
                    ->numeric(),
                TextEntry::make('estimated_municipality')
                    ->numeric(),
                TextEntry::make('estimated_users')
                    ->numeric(),
                TextEntry::make('estimated_others')
                    ->numeric(),
                TextEntry::make('estimated_total')
                    ->numeric(),
                TextEntry::make('actual_amount')
                    ->numeric(),
                TextEntry::make('actual_helvetas_cash')
                    ->numeric(),
                TextEntry::make('actual_helvetas_kd')
                    ->numeric(),
                TextEntry::make('actual_municipality')
                    ->numeric(),
                TextEntry::make('actual_users')
                    ->numeric(),
                TextEntry::make('actual_others')
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
