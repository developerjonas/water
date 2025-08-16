<?php

namespace App\Filament\Resources\WaterQualities\Pages;

use App\Filament\Resources\WaterQualities\WaterQualityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWaterQualities extends ListRecords
{
    protected static string $resource = WaterQualityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
