<?php

namespace App\Filament\Resources\PublicAudits\Pages;

use App\Filament\Resources\PublicAudits\PublicAuditResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePublicAudit extends CreateRecord
{
    protected static string $resource = PublicAuditResource::class;
}
