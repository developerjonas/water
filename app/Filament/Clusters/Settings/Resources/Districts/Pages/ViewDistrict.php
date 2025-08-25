<?php

namespace App\Filament\Clusters\Settings\Resources\Districts\Pages;

use App\Filament\Clusters\Settings\Resources\Districts\DistrictResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDistrict extends ViewRecord
{
    protected static string $resource = DistrictResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
