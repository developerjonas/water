<?php

namespace App\Filament\Resources\HouseholdSanitations\Pages;

use App\Filament\Resources\HouseholdSanitations\HouseholdSanitationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHouseholdSanitations extends ListRecords
{
    protected static string $resource = HouseholdSanitationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
