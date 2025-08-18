<?php

namespace App\Filament\Resources\PhotoBanks\Pages;

use App\Filament\Resources\PhotoBanks\PhotoBankResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPhotoBank extends ViewRecord
{
    protected static string $resource = PhotoBankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
