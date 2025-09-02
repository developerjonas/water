<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerStaff\Pages;

use App\Filament\Clusters\Settings\Resources\PartnerStaff\PartnerStaffResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPartnerStaff extends ViewRecord
{
    protected static string $resource = PartnerStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
