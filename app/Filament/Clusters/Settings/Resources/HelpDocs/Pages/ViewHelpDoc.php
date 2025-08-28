<?php

namespace App\Filament\Clusters\Settings\Resources\HelpDocs\Pages;

use App\Filament\Clusters\Settings\Resources\HelpDocs\HelpDocResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewHelpDoc extends ViewRecord
{
    protected static string $resource = HelpDocResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
