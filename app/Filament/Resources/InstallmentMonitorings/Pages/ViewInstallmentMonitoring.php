<?php

namespace App\Filament\Resources\InstallmentMonitorings\Pages;

use App\Filament\Resources\InstallmentMonitorings\InstallmentMonitoringResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewInstallmentMonitoring extends ViewRecord
{
    protected static string $resource = InstallmentMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
