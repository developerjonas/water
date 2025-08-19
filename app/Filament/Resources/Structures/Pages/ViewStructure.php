<?php

namespace App\Filament\Resources\Structures\Pages;

use App\Filament\Resources\Structures\StructureResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewStructure extends ViewRecord
{
    protected static string $resource = StructureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
