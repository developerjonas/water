<?php

namespace App\Filament\Resources\WaterPoints\Pages;

use App\Filament\Resources\WaterPoints\WaterPointResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWaterPoints extends ListRecords
{
    protected static string $resource = WaterPointResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
