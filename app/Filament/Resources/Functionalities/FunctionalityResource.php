<?php

namespace App\Filament\Resources\Functionalities;

use App\Filament\Resources\Functionalities\Pages\CreateFunctionality;
use App\Filament\Resources\Functionalities\Pages\EditFunctionality;
use App\Filament\Resources\Functionalities\Pages\ListFunctionalities;
use App\Filament\Resources\Functionalities\Pages\ViewFunctionality;
use App\Filament\Resources\Functionalities\Schemas\FunctionalityForm;
use App\Filament\Resources\Functionalities\Schemas\FunctionalityInfolist;
use App\Filament\Resources\Functionalities\Tables\FunctionalitiesTable;
use App\Models\Functionality;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FunctionalityResource extends Resource
{
    protected static ?string $model = Functionality::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::AdjustmentsVertical;

    protected static ?string $recordTitleAttribute = 'functionality_datas';

    protected static ?int $navigationSort = 11;


    public static function form(Schema $schema): Schema
    {
        return FunctionalityForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FunctionalityInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FunctionalitiesTable::configure($table);
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
            'index' => ListFunctionalities::route('/'),
            'create' => CreateFunctionality::route('/create'),
            'view' => ViewFunctionality::route('/{record}'),
            'edit' => EditFunctionality::route('/{record}/edit'),
        ];
    }
}
