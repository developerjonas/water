<?php

namespace App\Filament\Resources\Schemes\Pages;

use App\Filament\Resources\Schemes\SchemeResource;
use Filament\Actions\CreateAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Imports\SchemeImporter;

class ListSchemes extends ListRecords
{
    protected static string $resource = SchemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            ImportAction::make()->importer(SchemeImporter::class),
        ];
    }
}
