<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\Pages;

use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\SchemeBudgetSettlementResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSchemeBudgetSettlement extends ViewRecord
{
    protected static string $resource = SchemeBudgetSettlementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
