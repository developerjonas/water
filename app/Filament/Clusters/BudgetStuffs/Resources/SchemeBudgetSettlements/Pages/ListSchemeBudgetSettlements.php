<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\Pages;

use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\SchemeBudgetSettlementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSchemeBudgetSettlements extends ListRecords
{
    protected static string $resource = SchemeBudgetSettlementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
