<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SchemeBudgetInstallmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_budget_id')
                    ->required()
                    ->numeric(),
                TextInput::make('installment_number')
                    ->numeric(),
                TextInput::make('municipality')
                    ->numeric(),
                TextInput::make('helvetas_cash')
                    ->numeric(),
                TextInput::make('helvetas_kd')
                    ->numeric(),
                TextInput::make('users')
                    ->numeric(),
                TextInput::make('others')
                    ->numeric(),
                TextInput::make('total')
                    ->numeric(),
            ]);
    }
}
