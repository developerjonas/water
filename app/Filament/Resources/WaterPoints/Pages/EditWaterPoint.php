<?php

namespace App\Filament\Resources\WaterPoints\Pages;

use App\Filament\Resources\WaterPoints\WaterPointResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWaterPoint extends EditRecord
{
    protected static string $resource = WaterPointResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
