<?php

namespace App\Filament\Clusters\Budget\Resources\Subsidies;

use App\Filament\Clusters\Budget\BudgetCluster;
use App\Filament\Clusters\Budget\Resources\Subsidies\Pages\CreateSubsidy;
use App\Filament\Clusters\Budget\Resources\Subsidies\Pages\EditSubsidy;
use App\Filament\Clusters\Budget\Resources\Subsidies\Pages\ListSubsidies;
use App\Filament\Clusters\Budget\Resources\Subsidies\Pages\ViewSubsidy;
use App\Filament\Clusters\Budget\Resources\Subsidies\Schemas\SubsidyForm;
use App\Filament\Clusters\Budget\Resources\Subsidies\Schemas\SubsidyInfolist;
use App\Filament\Clusters\Budget\Resources\Subsidies\Tables\SubsidiesTable;
use App\Models\Subsidy;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SubsidyResource extends Resource
{
    protected static ?string $model = Subsidy::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = BudgetCluster::class;

    protected static ?string $recordTitleAttribute = 'subsidy_data';

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
