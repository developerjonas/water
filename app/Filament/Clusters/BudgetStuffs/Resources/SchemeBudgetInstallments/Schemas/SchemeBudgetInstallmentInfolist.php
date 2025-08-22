<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SchemeBudgetInstallmentInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_budget_id')
                    ->numeric(),
                TextEntry::make('installment_number')
                    ->numeric(),
                TextEntry::make('municipality')
                    ->numeric(),
                TextEntry::make('helvetas_cash')
                    ->numeric(),
                TextEntry::make('helvetas_kd')
                    ->numeric(),
                TextEntry::make('users')
                    ->numeric(),
                TextEntry::make('others')
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
