<?php

namespace App\Filament\Clusters\Settings\Resources\TrainingTypes\Pages;

use App\Filament\Clusters\Settings\Resources\TrainingTypes\TrainingTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTrainingTypes extends ListRecords
{
    protected static string $resource = TrainingTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
