<?php

namespace App\Filament\Resources\UserCommittees\Pages;

use App\Filament\Resources\UserCommittees\UserCommitteeResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUserCommittee extends ViewRecord
{
    protected static string $resource = UserCommitteeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
