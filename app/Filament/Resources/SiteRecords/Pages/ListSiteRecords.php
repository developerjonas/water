<?php

namespace App\Filament\Resources\SiteRecords\Pages;

use App\Filament\Resources\SiteRecords\SiteRecordResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSiteRecords extends ListRecords
{
    protected static string $resource = SiteRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
