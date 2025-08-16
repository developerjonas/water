<?php

namespace App\Filament\Resources\PublicAudits\Pages;

use App\Filament\Resources\PublicAudits\PublicAuditResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPublicAudit extends EditRecord
{
    protected static string $resource = PublicAuditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
