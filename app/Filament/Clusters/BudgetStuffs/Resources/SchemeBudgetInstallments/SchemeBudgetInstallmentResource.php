<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments;

use App\Filament\Clusters\BudgetStuffs\BudgetStuffsCluster;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\Pages\CreateSchemeBudgetInstallment;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\Pages\EditSchemeBudgetInstallment;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\Pages\ListSchemeBudgetInstallments;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\Pages\ViewSchemeBudgetInstallment;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\Schemas\SchemeBudgetInstallmentForm;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\Schemas\SchemeBudgetInstallmentInfolist;
use App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\Tables\SchemeBudgetInstallmentsTable;
use App\Models\SchemeBudgetInstallment;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SchemeBudgetInstallmentResource extends Resource
{
    protected static ?string $model = SchemeBudgetInstallment::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = BudgetStuffsCluster::class;

    protected static ?string $recordTitleAttribute = 'scheme_budget_installment';

    public static function form(Schema $schema): Schema
    {
        return SchemeBudgetInstallmentForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SchemeBudgetInstallmentInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SchemeBudgetInstallmentsTable::configure($table);
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
            'index' => ListSchemeBudgetInstallments::route('/'),
            'create' => CreateSchemeBudgetInstallment::route('/create'),
            'view' => ViewSchemeBudgetInstallment::route('/{record}'),
            'edit' => EditSchemeBudgetInstallment::route('/{record}/edit'),
        ];
    }
}
