<?php

namespace App\Filament\Clusters\Settings\Resources\Donors\Pages;

use App\Filament\Clusters\Settings\Resources\Donors\DonorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDonors extends ListRecords
{
    protected static string $resource = DonorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
