<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Pages;

use App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\PartnerNarrativeReportResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPartnerNarrativeReport extends EditRecord
{
    protected static string $resource = PartnerNarrativeReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
