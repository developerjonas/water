<?php

namespace App\Filament\Clusters\Budget\Resources\SubsidyApprovals\Pages;

use App\Filament\Clusters\Budget\Resources\SubsidyApprovals\SubsidyApprovalResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSubsidyApproval extends CreateRecord
{
    protected static string $resource = SubsidyApprovalResource::class;
}
