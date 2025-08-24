<?php

namespace App\Filament\Resources\Subsidies\Pages;

use App\Filament\Resources\Subsidies\SubsidyResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSubsidy extends ViewRecord
{
    protected static string $resource = SubsidyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
