<?php

namespace App\Filament\Resources\WaterPoints\Pages;

use App\Filament\Resources\WaterPoints\WaterPointResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWaterPoint extends ViewRecord
{
    protected static string $resource = WaterPointResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
