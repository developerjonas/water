<?php

namespace App\Filament\Clusters\Settings\Resources\Partners\Pages;

use App\Filament\Clusters\Settings\Resources\Partners\PartnerResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPartner extends ViewRecord
{
    protected static string $resource = PartnerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
