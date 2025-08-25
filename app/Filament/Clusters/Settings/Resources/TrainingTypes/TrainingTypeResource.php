<?php

namespace App\Filament\Clusters\Settings\Resources\TrainingTypes;

use App\Filament\Clusters\Settings\Resources\TrainingTypes\Pages\CreateTrainingType;
use App\Filament\Clusters\Settings\Resources\TrainingTypes\Pages\EditTrainingType;
use App\Filament\Clusters\Settings\Resources\TrainingTypes\Pages\ListTrainingTypes;
use App\Filament\Clusters\Settings\Resources\TrainingTypes\Pages\ViewTrainingType;
use App\Filament\Clusters\Settings\Resources\TrainingTypes\Schemas\TrainingTypeForm;
use App\Filament\Clusters\Settings\Resources\TrainingTypes\Schemas\TrainingTypeInfolist;
use App\Filament\Clusters\Settings\Resources\TrainingTypes\Tables\TrainingTypesTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\TrainingType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TrainingTypeResource extends Resource
{
    protected static ?string $model = TrainingType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;



    protected static ?string $cluster = SettingsCluster::class;

    protected static ?string $recordTitleAttribute = 'training_type_data';

    public static function form(Schema $schema): Schema
    {
        return TrainingTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TrainingTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TrainingTypesTable::configure($table);
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
            'index' => ListTrainingTypes::route('/'),
            'create' => CreateTrainingType::route('/create'),
            'view' => ViewTrainingType::route('/{record}'),
            'edit' => EditTrainingType::route('/{record}/edit'),
        ];
    }
}
