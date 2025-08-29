<?php

namespace App\Filament\Resources\Subsidies;

use App\Filament\Resources\Subsidies\Pages\CreateSubsidy;
use App\Filament\Resources\Subsidies\Pages\EditSubsidy;
use App\Filament\Resources\Subsidies\Pages\ListSubsidies;
use App\Filament\Resources\Subsidies\Pages\ViewSubsidy;
use App\Filament\Resources\Subsidies\Schemas\SubsidyForm;
use App\Filament\Resources\Subsidies\Schemas\SubsidyInfolist;
use App\Filament\Resources\Subsidies\Tables\SubsidiesTable;
use App\Models\Subsidy;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SubsidyResource extends Resource
{
    protected static ?string $model = Subsidy::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentCurrencyDollar;

    protected static ?string $recordTitleAttribute = 'subsidy_details';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = "Scheme Subsidy";

    public static function form(Schema $schema): Schema
    {
        return SubsidyForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SubsidyInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubsidiesTable::configure($table);
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
            'index' => ListSubsidies::route('/'),
            'create' => CreateSubsidy::route('/create'),
            'view' => ViewSubsidy::route('/{record}'),
            'edit' => EditSubsidy::route('/{record}/edit'),
        ];
    }
}
