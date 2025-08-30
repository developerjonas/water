<?php

namespace App\Filament\Clusters\Budget\Resources\Subsidies\Pages;

use App\Filament\Clusters\Budget\Resources\Subsidies\SubsidyResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSubsidy extends EditRecord
{
    protected static string $resource = SubsidyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
