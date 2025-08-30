<?php

namespace App\Filament\Clusters\Budget\Resources\SubsidyApprovals\Pages;

use App\Filament\Clusters\Budget\Resources\SubsidyApprovals\SubsidyApprovalResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSubsidyApprovals extends ListRecords
{
    protected static string $resource = SubsidyApprovalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
