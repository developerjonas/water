<?php

namespace App\Filament\Resources\GpsPhotos\Pages;

use App\Filament\Resources\GpsPhotos\GpsPhotoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewGpsPhoto extends ViewRecord
{
    protected static string $resource = GpsPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
