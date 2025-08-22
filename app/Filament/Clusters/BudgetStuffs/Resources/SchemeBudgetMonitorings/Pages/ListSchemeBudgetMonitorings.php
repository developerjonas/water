<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\Pages;

use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\SchemeBudgetMonitoringResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSchemeBudgetMonitorings extends ListRecords
{
    protected static string $resource = SchemeBudgetMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
