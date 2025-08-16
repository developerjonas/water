<?php

namespace App\Filament\Resources\WaterQualities;

use App\Filament\Resources\WaterQualities\Pages\CreateWaterQuality;
use App\Filament\Resources\WaterQualities\Pages\EditWaterQuality;
use App\Filament\Resources\WaterQualities\Pages\ListWaterQualities;
use App\Filament\Resources\WaterQualities\Pages\ViewWaterQuality;
use App\Filament\Resources\WaterQualities\Schemas\WaterQualityForm;
use App\Filament\Resources\WaterQualities\Schemas\WaterQualityInfolist;
use App\Filament\Resources\WaterQualities\Tables\WaterQualitiesTable;
use App\Models\WaterQuality;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WaterQualityResource extends Resource
{
    protected static ?string $model = WaterQuality::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'tested_point';

    public static function form(Schema $schema): Schema
    {
        return WaterQualityForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WaterQualityInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WaterQualitiesTable::configure($table);
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
            'index' => ListWaterQualities::route('/'),
            'create' => CreateWaterQuality::route('/create'),
            'view' => ViewWaterQuality::route('/{record}'),
            'edit' => EditWaterQuality::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
