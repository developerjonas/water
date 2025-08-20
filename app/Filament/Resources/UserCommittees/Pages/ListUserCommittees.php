<?php

namespace App\Filament\Resources\UserCommittees\Pages;

use App\Filament\Resources\UserCommittees\UserCommitteeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserCommittees extends ListRecords
{
    protected static string $resource = UserCommitteeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
