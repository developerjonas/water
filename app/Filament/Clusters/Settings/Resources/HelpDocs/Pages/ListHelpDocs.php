<?php

namespace App\Filament\Clusters\Settings\Resources\HelpDocs\Pages;

use App\Filament\Clusters\Settings\Resources\HelpDocs\HelpDocResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHelpDocs extends ListRecords
{
    protected static string $resource = HelpDocResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
