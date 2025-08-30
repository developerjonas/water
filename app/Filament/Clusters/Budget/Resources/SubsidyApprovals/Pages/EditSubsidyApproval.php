<?php

namespace App\Filament\Clusters\Budget\Resources\SubsidyApprovals\Pages;

use App\Filament\Clusters\Budget\Resources\SubsidyApprovals\SubsidyApprovalResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSubsidyApproval extends EditRecord
{
    protected static string $resource = SubsidyApprovalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
