<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SchemeBudgetSettlementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_budget_monitoring_id')
                    ->required()
                    ->numeric(),
                TextInput::make('settled_amount')
                    ->numeric(),
                Toggle::make('approved')
                    ->required(),
                Toggle::make('recovered')
                    ->required(),
            ]);
    }
}
