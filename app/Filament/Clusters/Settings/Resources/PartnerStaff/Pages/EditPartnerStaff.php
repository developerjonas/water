<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerStaff\Pages;

use App\Filament\Clusters\Settings\Resources\PartnerStaff\PartnerStaffResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPartnerStaff extends EditRecord
{
    protected static string $resource = PartnerStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
