<?php

namespace App\Filament\Resources\WaterQualityTests;

use App\Filament\Resources\WaterQualityTests\Pages\CreateWaterQualityTest;
use App\Filament\Resources\WaterQualityTests\Pages\EditWaterQualityTest;
use App\Filament\Resources\WaterQualityTests\Pages\ListWaterQualityTests;
use App\Filament\Resources\WaterQualityTests\Pages\ViewWaterQualityTest;
use App\Filament\Resources\WaterQualityTests\Schemas\WaterQualityTestForm;
use App\Filament\Resources\WaterQualityTests\Schemas\WaterQualityTestInfolist;
use App\Filament\Resources\WaterQualityTests\Tables\WaterQualityTestsTable;
use App\Models\WaterQualityTest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WaterQualityTestResource extends Resource
{
    protected static ?string $model = WaterQualityTest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentCheck;

    protected static ?string $recordTitleAttribute = 'water_quality_data';

    public static function form(Schema $schema): Schema
    {
        return WaterQualityTestForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WaterQualityTestInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WaterQualityTestsTable::configure($table);
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
            'index' => ListWaterQualityTests::route('/'),
            'create' => CreateWaterQualityTest::route('/create'),
            'view' => ViewWaterQualityTest::route('/{record}'),
            'edit' => EditWaterQualityTest::route('/{record}/edit'),
        ];
    }
}
