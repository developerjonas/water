<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\Pages;

use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\SchemeBudgetInstallmentResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSchemeBudgetInstallment extends EditRecord
{
    protected static string $resource = SchemeBudgetInstallmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
