<?php

namespace App\Filament\Resources\UserCommitteeInfos\Pages;

use App\Filament\Resources\UserCommitteeInfos\UserCommitteeInfoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserCommitteeInfos extends ListRecords
{
    protected static string $resource = UserCommitteeInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
