<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings;

use App\Filament\Clusters\BudgetStuffs\BudgetStuffsCluster;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\Pages\CreateSchemeBudgetMonitoring;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\Pages\EditSchemeBudgetMonitoring;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\Pages\ListSchemeBudgetMonitorings;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\Pages\ViewSchemeBudgetMonitoring;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\Schemas\SchemeBudgetMonitoringForm;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\Schemas\SchemeBudgetMonitoringInfolist;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetMonitorings\Tables\SchemeBudgetMonitoringsTable;
use App\Models\SchemeBudgetMonitoring;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SchemeBudgetMonitoringResource extends Resource
{
    protected static ?string $model = SchemeBudgetMonitoring::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = BudgetStuffsCluster::class;

    protected static ?string $recordTitleAttribute = 'scheme_budget_monitoring_data';

    public static function form(Schema $schema): Schema
    {
        return SchemeBudgetMonitoringForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SchemeBudgetMonitoringInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchemeBudgetMonitoringsTable::configure($table);
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
            'index' => ListSchemeBudgetMonitorings::route('/'),
            'create' => CreateSchemeBudgetMonitoring::route('/create'),
            'view' => ViewSchemeBudgetMonitoring::route('/{record}'),
            'edit' => EditSchemeBudgetMonitoring::route('/{record}/edit'),
        ];
    }
}
