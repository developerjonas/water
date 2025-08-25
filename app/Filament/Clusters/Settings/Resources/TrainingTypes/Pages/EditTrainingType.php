<?php

namespace App\Filament\Clusters\Settings\Resources\TrainingTypes\Pages;

use App\Filament\Clusters\Settings\Resources\TrainingTypes\TrainingTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTrainingType extends EditRecord
{
    protected static string $resource = TrainingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
