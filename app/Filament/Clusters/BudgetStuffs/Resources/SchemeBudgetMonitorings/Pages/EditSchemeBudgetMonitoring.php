<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\Pages;

use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\SchemeBudgetMonitoringResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSchemeBudgetMonitoring extends EditRecord
{
    protected static string $resource = SchemeBudgetMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
