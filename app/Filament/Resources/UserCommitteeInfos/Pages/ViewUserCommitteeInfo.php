<?php

namespace App\Filament\Resources\UserCommitteeInfos\Pages;

use App\Filament\Resources\UserCommitteeInfos\UserCommitteeInfoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUserCommitteeInfo extends ViewRecord
{
    protected static string $resource = UserCommitteeInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
