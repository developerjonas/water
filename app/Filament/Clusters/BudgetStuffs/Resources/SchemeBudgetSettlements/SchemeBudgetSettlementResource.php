<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements;

use App\Filament\Clusters\BudgetStuffs\BudgetStuffsCluster;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\Pages\CreateSchemeBudgetSettlement;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\Pages\EditSchemeBudgetSettlement;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\Pages\ListSchemeBudgetSettlements;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\Pages\ViewSchemeBudgetSettlement;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\Schemas\SchemeBudgetSettlementForm;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\Schemas\SchemeBudgetSettlementInfolist;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetSettlements\Tables\SchemeBudgetSettlementsTable;
use App\Models\SchemeBudgetSettlement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SchemeBudgetSettlementResource extends Resource
{
    protected static ?string $model = SchemeBudgetSettlement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = BudgetStuffsCluster::class;

    protected static ?string $recordTitleAttribute = 'scheme_budget_settlement_data';

    public static function form(Schema $schema): Schema
    {
        return SchemeBudgetSettlementForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SchemeBudgetSettlementInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchemeBudgetSettlementsTable::configure($table);
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
            'index' => ListSchemeBudgetSettlements::route('/'),
            'create' => CreateSchemeBudgetSettlement::route('/create'),
            'view' => ViewSchemeBudgetSettlement::route('/{record}'),
            'edit' => EditSchemeBudgetSettlement::route('/{record}/edit'),
        ];
    }
}
