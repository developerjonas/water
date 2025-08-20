<?php

namespace App\Filament\Resources\SanitationMetrics\Pages;

use App\Filament\Resources\SanitationMetrics\SanitationMetricResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSanitationMetric extends EditRecord
{
    protected static string $resource = SanitationMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
