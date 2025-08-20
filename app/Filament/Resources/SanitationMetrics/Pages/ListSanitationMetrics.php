<?php

namespace App\Filament\Resources\SanitationMetrics\Pages;

use App\Filament\Resources\SanitationMetrics\SanitationMetricResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSanitationMetrics extends ListRecords
{
    protected static string $resource = SanitationMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
