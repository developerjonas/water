<?php

namespace App\Filament\Resources\FollowUpSurveys;

use App\Filament\Resources\FollowUpSurveys\Pages\CreateFollowUpSurvey;
use App\Filament\Resources\FollowUpSurveys\Pages\EditFollowUpSurvey;
use App\Filament\Resources\FollowUpSurveys\Pages\ListFollowUpSurveys;
use App\Filament\Resources\FollowUpSurveys\Pages\ViewFollowUpSurvey;
use App\Filament\Resources\FollowUpSurveys\Schemas\FollowUpSurveyForm;
use App\Filament\Resources\FollowUpSurveys\Schemas\FollowUpSurveyInfolist;
use App\Filament\Resources\FollowUpSurveys\Tables\FollowUpSurveysTable;
use App\Models\FollowUpSurvey;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FollowUpSurveyResource extends Resource
{
    protected static ?string $model = FollowUpSurvey::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentList;

    protected static ?string $recordTitleAttribute = 'follow_up_survey_data';

    protected static ?int $navigationSort = 500;

    public static function form(Schema $schema): Schema
    {
        return FollowUpSurveyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FollowUpSurveyInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FollowUpSurveysTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFollowUpSurveys::route('/'),
            'create' => CreateFollowUpSurvey::route('/create'),
            'view' => ViewFollowUpSurvey::route('/{record}'),
            'edit' => EditFollowUpSurvey::route('/{record}/edit'),
        ];
    }
}
