<?php

namespace App\Filament\Resources\FollowUpSurveys\Pages;

use App\Filament\Resources\FollowUpSurveys\FollowUpSurveyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFollowUpSurveys extends ListRecords
{
    protected static string $resource = FollowUpSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
