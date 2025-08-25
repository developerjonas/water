<?php

namespace App\Filament\Resources\SchemeSubSystems\Pages;

use App\Filament\Resources\SchemeSubSystems\SchemeSubSystemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSchemeSubSystems extends ListRecords
{
    protected static string $resource = SchemeSubSystemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
