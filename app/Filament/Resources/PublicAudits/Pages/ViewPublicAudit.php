<?php

namespace App\Filament\Resources\PublicAudits\Pages;

use App\Filament\Resources\PublicAudits\PublicAuditResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPublicAudit extends ViewRecord
{
    protected static string $resource = PublicAuditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
