<?php

namespace App\Filament\Clusters\Settings\Resources\Municipalities\Pages;

use App\Filament\Clusters\Settings\Resources\Municipalities\MunicipalityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMunicipalities extends ListRecords
{
    protected static string $resource = MunicipalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
