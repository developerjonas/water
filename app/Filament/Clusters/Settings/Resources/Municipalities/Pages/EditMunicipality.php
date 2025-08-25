<?php

namespace App\Filament\Clusters\Settings\Resources\Municipalities\Pages;

use App\Filament\Clusters\Settings\Resources\Municipalities\MunicipalityResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMunicipality extends EditRecord
{
    protected static string $resource = MunicipalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
