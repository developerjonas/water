<?php

namespace App\Filament\Resources\GpsPhotos\Pages;

use App\Filament\Resources\GpsPhotos\GpsPhotoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGpsPhotos extends ListRecords
{
    protected static string $resource = GpsPhotoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
