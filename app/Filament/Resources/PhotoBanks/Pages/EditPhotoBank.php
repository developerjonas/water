<?php

namespace App\Filament\Resources\PhotoBanks\Pages;

use App\Filament\Resources\PhotoBanks\PhotoBankResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPhotoBank extends EditRecord
{
    protected static string $resource = PhotoBankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
