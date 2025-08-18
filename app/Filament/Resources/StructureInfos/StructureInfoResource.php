<?php

namespace App\Filament\Resources\StructureInfos;

use App\Filament\Resources\StructureInfos\Pages\CreateStructureInfo;
use App\Filament\Resources\StructureInfos\Pages\EditStructureInfo;
use App\Filament\Resources\StructureInfos\Pages\ListStructureInfos;
use App\Filament\Resources\StructureInfos\Pages\ViewStructureInfo;
use App\Filament\Resources\StructureInfos\Schemas\StructureInfoForm;
use App\Filament\Resources\StructureInfos\Schemas\StructureInfoInfolist;
use App\Filament\Resources\StructureInfos\Tables\StructureInfosTable;
use App\Models\StructureInfo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StructureInfoResource extends Resource
{
    protected static ?string $model = StructureInfo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'structure_info';

    public static function form(Schema $schema): Schema
    {
        return StructureInfoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StructureInfoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StructureInfosTable::configure($table);
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
            'index' => ListStructureInfos::route('/'),
            'create' => CreateStructureInfo::route('/create'),
            'view' => ViewStructureInfo::route('/{record}'),
            'edit' => EditStructureInfo::route('/{record}/edit'),
        ];
    }
}
