<?php

namespace App\Filament\Clusters\Budget\Resources\Monitorings\Pages;

use App\Filament\Clusters\Budget\Resources\Monitorings\MonitoringResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMonitoring extends ViewRecord
{
    protected static string $resource = MonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
