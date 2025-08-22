<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\Pages;

use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\SchemeBudgetResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSchemeBudget extends EditRecord
{
    protected static string $resource = SchemeBudgetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
