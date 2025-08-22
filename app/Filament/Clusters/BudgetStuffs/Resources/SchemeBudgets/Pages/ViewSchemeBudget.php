<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\Pages;

use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\SchemeBudgetResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSchemeBudget extends ViewRecord
{
    protected static string $resource = SchemeBudgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
