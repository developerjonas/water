<?php

namespace App\Filament\Resources\StructureInfos\Pages;

use App\Filament\Resources\StructureInfos\StructureInfoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStructureInfo extends ViewRecord
{
    protected static string $resource = StructureInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
