<?php

namespace App\Filament\Clusters\Settings\Resources\Donors\Pages;

use App\Filament\Clusters\Settings\Resources\Donors\DonorResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDonor extends ViewRecord
{
    protected static string $resource = DonorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
