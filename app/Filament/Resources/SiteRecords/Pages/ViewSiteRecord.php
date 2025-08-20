<?php

namespace App\Filament\Resources\SiteRecords\Pages;

use App\Filament\Resources\SiteRecords\SiteRecordResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSiteRecord extends ViewRecord
{
    protected static string $resource = SiteRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
