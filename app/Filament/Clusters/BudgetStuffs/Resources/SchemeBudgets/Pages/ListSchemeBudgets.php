<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\Pages;

use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\SchemeBudgetResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSchemeBudgets extends ListRecords
{
    protected static string $resource = SchemeBudgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
