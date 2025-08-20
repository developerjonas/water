<?php

namespace App\Filament\Resources\WaterQualityTests\Pages;

use App\Filament\Resources\WaterQualityTests\WaterQualityTestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWaterQualityTests extends ListRecords
{
    protected static string $resource = WaterQualityTestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
