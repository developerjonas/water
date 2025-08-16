<?php

namespace App\Filament\Resources\PublicAudits\Pages;

use App\Filament\Resources\PublicAudits\PublicAuditResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPublicAudits extends ListRecords
{
    protected static string $resource = PublicAuditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
