<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\Pages;

use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\SchemeBudgetSettlementResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSchemeBudgetSettlement extends EditRecord
{
    protected static string $resource = SchemeBudgetSettlementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
