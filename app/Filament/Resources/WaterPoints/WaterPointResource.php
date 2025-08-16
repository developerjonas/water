<?php

namespace App\Filament\Resources\WaterPoints;

use App\Filament\Resources\WaterPoints\Pages\CreateWaterPoint;
use App\Filament\Resources\WaterPoints\Pages\EditWaterPoint;
use App\Filament\Resources\WaterPoints\Pages\ListWaterPoints;
use App\Filament\Resources\WaterPoints\Pages\ViewWaterPoint;
use App\Filament\Resources\WaterPoints\Schemas\WaterPointForm;
use App\Filament\Resources\WaterPoints\Schemas\WaterPointInfolist;
use App\Filament\Resources\WaterPoints\Tables\WaterPointsTable;
use App\Models\WaterPoint;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WaterPointResource extends Resource
{
    protected static ?string $model = WaterPoint::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'water_point_data';

    public static function form(Schema $schema): Schema
    {
        return WaterPointForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WaterPointInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WaterPointsTable::configure($table);
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
            'index' => ListWaterPoints::route('/'),
            'create' => CreateWaterPoint::route('/create'),
            'view' => ViewWaterPoint::route('/{record}'),
            'edit' => EditWaterPoint::route('/{record}/edit'),
        ];
    }
}
