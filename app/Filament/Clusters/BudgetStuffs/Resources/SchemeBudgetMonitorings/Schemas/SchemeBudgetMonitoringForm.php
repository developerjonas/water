<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SchemeBudgetMonitoringForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_budget_installment_id')
                    ->required()
                    ->numeric(),
                TextInput::make('description'),
                TextInput::make('estimated_amount')
                    ->numeric(),
                TextInput::make('spent_amount')
                    ->numeric(),
                Toggle::make('verified')
                    ->required(),
            ]);
    }
}
