<?php

namespace App\Filament\Resources\InstallmentMonitorings\Pages;

use App\Filament\Resources\InstallmentMonitorings\InstallmentMonitoringResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInstallmentMonitorings extends ListRecords
{
    protected static string $resource = InstallmentMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
