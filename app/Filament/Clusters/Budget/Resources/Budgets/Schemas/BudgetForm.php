<?php

namespace App\Filament\Clusters\Budget\Resources\Budgets\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BudgetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_code')
                    ->required(),
                TextInput::make('budget_code'),
                TextInput::make('helvetas_estimated_cash')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('helvetas_estimated_kind')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('helvetas_estimated_total')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('community_contribution')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('palika_estimated')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('total_estimated')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Textarea::make('remarks')
                    ->columnSpanFull(),
                TextInput::make('budget_status')
                    ->required()
                    ->default('draft'),
            ]);
    }
}
