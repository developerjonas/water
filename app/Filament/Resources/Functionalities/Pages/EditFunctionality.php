<?php

namespace App\Filament\Resources\Functionalities\Pages;

use App\Filament\Resources\Functionalities\FunctionalityResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditFunctionality extends EditRecord
{
    protected static string $resource = FunctionalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
