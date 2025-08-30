<?php

namespace App\Filament\Clusters\Budget\Resources\SubsidyApprovals\Pages;

use App\Filament\Clusters\Budget\Resources\SubsidyApprovals\SubsidyApprovalResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSubsidyApproval extends ViewRecord
{
    protected static string $resource = SubsidyApprovalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
