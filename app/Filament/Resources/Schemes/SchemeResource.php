<?php

namespace App\Filament\Resources\Schemes;

use App\Filament\Resources\Schemes\Pages\CreateScheme;
use App\Filament\Resources\Schemes\Pages\EditScheme;
use App\Filament\Resources\Schemes\Pages\ListSchemes;
use App\Filament\Resources\Schemes\Pages\ViewScheme;
use App\Filament\Resources\Schemes\RelationManagers\StructureRelationManager;
use App\Filament\Resources\Schemes\RelationManagers\UserCommitteeRelationManager;
use App\Filament\Resources\Schemes\Schemas\SchemeForm;
use App\Filament\Resources\Schemes\Schemas\SchemeInfolist;
use App\Filament\Resources\Schemes\Tables\SchemesTable;
use App\Models\Scheme;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\Schemes\RelationManagers\BeneficiaryRelationManager;


class SchemeResource extends Resource
{
    protected static ?string $model = Scheme::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingLibrary;

    public static function form(Schema $schema): Schema
    {
        return SchemeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SchemeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchemesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            'beneficiaries' => BeneficiaryRelationManager::class,
            'committees' => UserCommitteeRelationManager::class,
            'structures' => StructureRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSchemes::route('/'),
            'create' => CreateScheme::route('/create'),
            'view' => ViewScheme::route('/{record}'),
            'edit' => EditScheme::route('/{record}/edit'),
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
