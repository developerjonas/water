<?php

namespace App\Filament\Resources\SchemeSubSystems\Pages;

use App\Filament\Resources\SchemeSubSystems\SchemeSubSystemResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSchemeSubSystem extends EditRecord
{
    protected static string $resource = SchemeSubSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
