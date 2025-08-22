<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\Pages;

use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\SchemeBudgetMonitoringResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSchemeBudgetMonitoring extends ViewRecord
{
    protected static string $resource = SchemeBudgetMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
