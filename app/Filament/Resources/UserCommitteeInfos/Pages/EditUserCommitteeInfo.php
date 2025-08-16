<?php

namespace App\Filament\Resources\UserCommitteeInfos\Pages;

use App\Filament\Resources\UserCommitteeInfos\UserCommitteeInfoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUserCommitteeInfo extends EditRecord
{
    protected static string $resource = UserCommitteeInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
