<?php

namespace App\Filament\Resources\WaterPoints\Pages;

use App\Filament\Resources\WaterPoints\WaterPointResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Imports\WaterPointImporter;

class ListWaterPoints extends ListRecords
{
    protected static string $resource = WaterPointResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ImportAction::make()->importer(WaterPointImporter::class),
        ];
    }
}
