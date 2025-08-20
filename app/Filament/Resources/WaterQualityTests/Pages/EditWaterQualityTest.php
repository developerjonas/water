<?php

namespace App\Filament\Resources\WaterQualityTests\Pages;

use App\Filament\Resources\WaterQualityTests\WaterQualityTestResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWaterQualityTest extends EditRecord
{
    protected static string $resource = WaterQualityTestResource::class;

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
