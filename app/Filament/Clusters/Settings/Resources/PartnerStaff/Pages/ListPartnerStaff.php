<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerStaff\Pages;

use App\Filament\Clusters\Settings\Resources\PartnerStaff\PartnerStaffResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPartnerStaff extends ListRecords
{
    protected static string $resource = PartnerStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
