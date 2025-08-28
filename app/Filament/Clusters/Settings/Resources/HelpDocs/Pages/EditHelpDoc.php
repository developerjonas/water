<?php

namespace App\Filament\Clusters\Settings\Resources\HelpDocs\Pages;

use App\Filament\Clusters\Settings\Resources\HelpDocs\HelpDocResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditHelpDoc extends EditRecord
{
    protected static string $resource = HelpDocResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
