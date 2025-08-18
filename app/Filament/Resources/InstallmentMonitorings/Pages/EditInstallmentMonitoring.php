<?php

namespace App\Filament\Resources\InstallmentMonitorings\Pages;

use App\Filament\Resources\InstallmentMonitorings\InstallmentMonitoringResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditInstallmentMonitoring extends EditRecord
{
    protected static string $resource = InstallmentMonitoringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
