<?php

namespace App\Filament\Clusters\Settings\Resources\Municipalities\Pages;

use App\Filament\Clusters\Settings\Resources\Municipalities\MunicipalityResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMunicipality extends ViewRecord
{
    protected static string $resource = MunicipalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
