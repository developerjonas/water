<?php

namespace App\Filament\Resources\WaterQualityTests\Pages;

use App\Filament\Resources\WaterQualityTests\WaterQualityTestResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWaterQualityTest extends ViewRecord
{
    protected static string $resource = WaterQualityTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
