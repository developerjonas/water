<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Pages;

use App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\PartnerNarrativeReportResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPartnerNarrativeReports extends ListRecords
{
    protected static string $resource = PartnerNarrativeReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
