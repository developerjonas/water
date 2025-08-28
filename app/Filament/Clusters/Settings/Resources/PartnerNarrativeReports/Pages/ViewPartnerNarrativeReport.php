<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Pages;

use App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\PartnerNarrativeReportResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPartnerNarrativeReport extends ViewRecord
{
    protected static string $resource = PartnerNarrativeReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
