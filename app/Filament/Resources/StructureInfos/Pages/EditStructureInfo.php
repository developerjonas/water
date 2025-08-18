<?php

namespace App\Filament\Resources\StructureInfos\Pages;

use App\Filament\Resources\StructureInfos\StructureInfoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditStructureInfo extends EditRecord
{
    protected static string $resource = StructureInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
