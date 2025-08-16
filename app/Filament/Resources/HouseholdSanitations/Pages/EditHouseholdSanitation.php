<?php

namespace App\Filament\Resources\HouseholdSanitations\Pages;

use App\Filament\Resources\HouseholdSanitations\HouseholdSanitationResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditHouseholdSanitation extends EditRecord
{
    protected static string $resource = HouseholdSanitationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
