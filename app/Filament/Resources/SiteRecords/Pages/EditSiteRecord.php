<?php

namespace App\Filament\Resources\SiteRecords\Pages;

use App\Filament\Resources\SiteRecords\SiteRecordResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSiteRecord extends EditRecord
{
    protected static string $resource = SiteRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
