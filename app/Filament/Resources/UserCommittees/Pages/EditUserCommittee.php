<?php

namespace App\Filament\Resources\UserCommittees\Pages;

use App\Filament\Resources\UserCommittees\UserCommitteeResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUserCommittee extends EditRecord
{
    protected static string $resource = UserCommitteeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
