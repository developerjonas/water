<?php

namespace App\Filament\Resources\StructureInfos\Pages;

use App\Filament\Resources\StructureInfos\StructureInfoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStructureInfos extends ListRecords
{
    protected static string $resource = StructureInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
