<?php

namespace App\Filament\Resources\FollowUpSurveys\Pages;

use App\Filament\Resources\FollowUpSurveys\FollowUpSurveyResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditFollowUpSurvey extends EditRecord
{
    protected static string $resource = FollowUpSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
