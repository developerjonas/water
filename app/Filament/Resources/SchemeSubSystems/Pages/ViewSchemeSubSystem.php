<?php

namespace App\Filament\Resources\SchemeSubSystems\Pages;

use App\Filament\Resources\SchemeSubSystems\SchemeSubSystemResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSchemeSubSystem extends ViewRecord
{
    protected static string $resource = SchemeSubSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
