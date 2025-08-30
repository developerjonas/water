<?php

namespace App\Filament\Clusters\Budget\Resources\SubsidyApprovals;

use App\Filament\Clusters\Budget\BudgetCluster;
use App\Filament\Clusters\Budget\Resources\SubsidyApprovals\Pages\CreateSubsidyApproval;
use App\Filament\Clusters\Budget\Resources\SubsidyApprovals\Pages\EditSubsidyApproval;
use App\Filament\Clusters\Budget\Resources\SubsidyApprovals\Pages\ListSubsidyApprovals;
use App\Filament\Clusters\Budget\Resources\SubsidyApprovals\Pages\ViewSubsidyApproval;
use App\Filament\Clusters\Budget\Resources\SubsidyApprovals\Schemas\SubsidyApprovalForm;
use App\Filament\Clusters\Budget\Resources\SubsidyApprovals\Schemas\SubsidyApprovalInfolist;
use App\Filament\Clusters\Budget\Resources\SubsidyApprovals\Tables\SubsidyApprovalsTable;
use App\Models\SubsidyApproval;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SubsidyApprovalResource extends Resource
{
    protected static ?string $model = SubsidyApproval::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = BudgetCluster::class;

    protected static ?string $recordTitleAttribute = 'subsidy_approval_data';

    public static function form(Schema $schema): Schema
    {
        return SubsidyApprovalForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SubsidyApprovalInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubsidyApprovalsTable::configure($table);
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
            'index' => ListSubsidyApprovals::route('/'),
            'create' => CreateSubsidyApproval::route('/create'),
            'view' => ViewSubsidyApproval::route('/{record}'),
            'edit' => EditSubsidyApproval::route('/{record}/edit'),
        ];
    }
}
