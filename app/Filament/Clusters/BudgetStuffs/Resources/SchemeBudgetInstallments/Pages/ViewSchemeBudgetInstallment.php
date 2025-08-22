<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\Pages;

use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\SchemeBudgetInstallmentResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSchemeBudgetInstallment extends ViewRecord
{
    protected static string $resource = SchemeBudgetInstallmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
