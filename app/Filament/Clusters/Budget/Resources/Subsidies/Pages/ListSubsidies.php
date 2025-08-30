<?php

namespace App\Filament\Clusters\Budget\Resources\Subsidies\Pages;

use App\Filament\Clusters\Budget\Resources\Subsidies\SubsidyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSubsidies extends ListRecords
{
    protected static string $resource = SubsidyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
