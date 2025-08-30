<?php

namespace App\Filament\Clusters\Budget\Resources\Budgets\Pages;

use App\Filament\Clusters\Budget\Resources\Budgets\BudgetResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBudget extends ViewRecord
{
    protected static string $resource = BudgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
