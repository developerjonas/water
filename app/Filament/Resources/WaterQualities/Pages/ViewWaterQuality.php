<?php

namespace App\Filament\Resources\WaterQualities\Pages;

use App\Filament\Resources\WaterQualities\WaterQualityResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWaterQuality extends ViewRecord
{
    protected static string $resource = WaterQualityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
