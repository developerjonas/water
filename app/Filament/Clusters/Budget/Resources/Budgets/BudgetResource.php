<?php

namespace App\Filament\Clusters\Budget\Resources\Budgets;

use App\Filament\Clusters\Budget\BudgetCluster;
use App\Filament\Clusters\Budget\Resources\Budgets\Pages\CreateBudget;
use App\Filament\Clusters\Budget\Resources\Budgets\Pages\EditBudget;
use App\Filament\Clusters\Budget\Resources\Budgets\Pages\ListBudgets;
use App\Filament\Clusters\Budget\Resources\Budgets\Pages\ViewBudget;
use App\Filament\Clusters\Budget\Resources\Budgets\Schemas\BudgetForm;
use App\Filament\Clusters\Budget\Resources\Budgets\Schemas\BudgetInfolist;
use App\Filament\Clusters\Budget\Resources\Budgets\Tables\BudgetsTable;
use App\Models\Budget;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BudgetResource extends Resource
{
    protected static ?string $model = Budget::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = BudgetCluster::class;

    protected static ?string $recordTitleAttribute = 'budet_data';

    public static function form(Schema $schema): Schema
    {
        return BudgetForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BudgetInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BudgetsTable::configure($table);
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
            'index' => ListBudgets::route('/'),
            'create' => CreateBudget::route('/create'),
            'view' => ViewBudget::route('/{record}'),
            'edit' => EditBudget::route('/{record}/edit'),
        ];
    }
}
