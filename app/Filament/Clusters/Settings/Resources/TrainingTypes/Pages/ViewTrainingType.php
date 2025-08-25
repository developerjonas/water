<?php

namespace App\Filament\Clusters\Settings\Resources\TrainingTypes\Pages;

use App\Filament\Clusters\Settings\Resources\TrainingTypes\TrainingTypeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTrainingType extends ViewRecord
{
    protected static string $resource = TrainingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
