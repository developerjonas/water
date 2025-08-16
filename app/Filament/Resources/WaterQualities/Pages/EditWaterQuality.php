<?php

namespace App\Filament\Resources\WaterQualities\Pages;

use App\Filament\Resources\WaterQualities\WaterQualityResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWaterQuality extends EditRecord
{
    protected static string $resource = WaterQualityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
