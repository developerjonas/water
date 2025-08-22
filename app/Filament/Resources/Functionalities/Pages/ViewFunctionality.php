<?php

namespace App\Filament\Resources\Functionalities\Pages;

use App\Filament\Resources\Functionalities\FunctionalityResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFunctionality extends ViewRecord
{
    protected static string $resource = FunctionalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
