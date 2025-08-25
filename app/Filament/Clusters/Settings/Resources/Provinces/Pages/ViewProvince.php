<?php

namespace App\Filament\Clusters\Settings\Resources\Provinces\Pages;

use App\Filament\Clusters\Settings\Resources\Provinces\ProvinceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProvince extends ViewRecord
{
    protected static string $resource = ProvinceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
