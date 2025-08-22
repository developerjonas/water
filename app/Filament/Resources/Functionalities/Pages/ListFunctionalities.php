<?php

namespace App\Filament\Resources\Functionalities\Pages;

use App\Filament\Resources\Functionalities\FunctionalityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFunctionalities extends ListRecords
{
    protected static string $resource = FunctionalityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
