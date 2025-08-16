<?php

namespace App\Filament\Resources\HouseholdSanitations\Pages;

use App\Filament\Resources\HouseholdSanitations\HouseholdSanitationResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHouseholdSanitation extends ViewRecord
{
    protected static string $resource = HouseholdSanitationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
