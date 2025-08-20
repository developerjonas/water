<?php

namespace App\Filament\Resources\GpsPhotos\Pages;

use App\Filament\Resources\GpsPhotos\GpsPhotoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditGpsPhoto extends EditRecord
{
    protected static string $resource = GpsPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
