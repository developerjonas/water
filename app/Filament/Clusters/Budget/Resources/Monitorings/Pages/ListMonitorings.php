<?php

namespace App\Filament\Clusters\Budget\Resources\Monitorings\Pages;

use App\Filament\Clusters\Budget\Resources\Monitorings\MonitoringResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMonitorings extends ListRecords
{
    protected static string $resource = MonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
