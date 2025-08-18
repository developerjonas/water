<?php

namespace App\Filament\Resources\InstallmentMonitorings;

use App\Filament\Resources\InstallmentMonitorings\Pages\CreateInstallmentMonitoring;
use App\Filament\Resources\InstallmentMonitorings\Pages\EditInstallmentMonitoring;
use App\Filament\Resources\InstallmentMonitorings\Pages\ListInstallmentMonitorings;
use App\Filament\Resources\InstallmentMonitorings\Pages\ViewInstallmentMonitoring;
use App\Filament\Resources\InstallmentMonitorings\Schemas\InstallmentMonitoringForm;
use App\Filament\Resources\InstallmentMonitorings\Schemas\InstallmentMonitoringInfolist;
use App\Filament\Resources\InstallmentMonitorings\Tables\InstallmentMonitoringsTable;
use App\Models\InstallmentMonitoring;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class InstallmentMonitoringResource extends Resource
{
    protected static ?string $model = InstallmentMonitoring::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'installment_monitoring_data';

        protected static string | UnitEnum | null $navigationGroup = 'Financial Stuffs';


    public static function form(Schema $schema): Schema
    {
        return InstallmentMonitoringForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InstallmentMonitoringInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InstallmentMonitoringsTable::configure($table);
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
            'index' => ListInstallmentMonitorings::route('/'),
            'create' => CreateInstallmentMonitoring::route('/create'),
            'view' => ViewInstallmentMonitoring::route('/{record}'),
            'edit' => EditInstallmentMonitoring::route('/{record}/edit'),
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
