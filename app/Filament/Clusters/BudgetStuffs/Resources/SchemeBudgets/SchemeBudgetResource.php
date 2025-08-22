<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets;

use App\Filament\Clusters\BudgetStuffs\BudgetStuffsCluster;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\Pages\CreateSchemeBudget;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\Pages\EditSchemeBudget;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\Pages\ListSchemeBudgets;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\Pages\ViewSchemeBudget;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\Schemas\SchemeBudgetForm;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\Schemas\SchemeBudgetInfolist;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\Tables\SchemeBudgetsTable;
use App\Models\SchemeBudget;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SchemeBudgetResource extends Resource
{
    protected static ?string $model = SchemeBudget::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = BudgetStuffsCluster::class;

    protected static ?string $recordTitleAttribute = 'schem_budget_data';

    public static function form(Schema $schema): Schema
    {
        return SchemeBudgetForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SchemeBudgetInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchemeBudgetsTable::configure($table);
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
            'index' => ListSchemeBudgets::route('/'),
            'create' => CreateSchemeBudget::route('/create'),
            'view' => ViewSchemeBudget::route('/{record}'),
            'edit' => EditSchemeBudget::route('/{record}/edit'),
        ];
    }
}
