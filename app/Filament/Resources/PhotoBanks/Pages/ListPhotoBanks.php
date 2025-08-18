<?php

namespace App\Filament\Resources\PhotoBanks\Pages;

use App\Filament\Resources\PhotoBanks\PhotoBankResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPhotoBanks extends ListRecords
{
    protected static string $resource = PhotoBankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
