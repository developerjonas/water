<?php

namespace App\Filament\Resources\SchemeSubSystems;

use App\Filament\Resources\SchemeSubSystems\Pages\CreateSchemeSubSystem;
use App\Filament\Resources\SchemeSubSystems\Pages\EditSchemeSubSystem;
use App\Filament\Resources\SchemeSubSystems\Pages\ListSchemeSubSystems;
use App\Filament\Resources\SchemeSubSystems\Pages\ViewSchemeSubSystem;
use App\Filament\Resources\SchemeSubSystems\Schemas\SchemeSubSystemForm;
use App\Filament\Resources\SchemeSubSystems\Schemas\SchemeSubSystemInfolist;
use App\Filament\Resources\SchemeSubSystems\Tables\SchemeSubSystemsTable;
use App\Models\SchemeSubSystem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchemeSubSystemResource extends Resource
{
    protected static ?string $model = SchemeSubSystem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'sub_system_data';

    public static function form(Schema $schema): Schema
    {
        return SchemeSubSystemForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SchemeSubSystemInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchemeSubSystemsTable::configure($table);
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
            'index' => ListSchemeSubSystems::route('/'),
            'create' => CreateSchemeSubSystem::route('/create'),
            'view' => ViewSchemeSubSystem::route('/{record}'),
            'edit' => EditSchemeSubSystem::route('/{record}/edit'),
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
