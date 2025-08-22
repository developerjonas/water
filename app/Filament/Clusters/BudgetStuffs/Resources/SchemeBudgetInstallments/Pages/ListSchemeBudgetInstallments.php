<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\Pages;

use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\SchemeBudgetInstallmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSchemeBudgetInstallments extends ListRecords
{
    protected static string $resource = SchemeBudgetInstallmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
