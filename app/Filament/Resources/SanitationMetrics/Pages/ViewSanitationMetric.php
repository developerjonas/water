<?php

namespace App\Filament\Resources\SanitationMetrics\Pages;

use App\Filament\Resources\SanitationMetrics\SanitationMetricResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSanitationMetric extends ViewRecord
{
    protected static string $resource = SanitationMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
