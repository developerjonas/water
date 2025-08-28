<?php

namespace App\Filament\Resources\FollowUpSurveys\Pages;

use App\Filament\Resources\FollowUpSurveys\FollowUpSurveyResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFollowUpSurvey extends ViewRecord
{
    protected static string $resource = FollowUpSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
