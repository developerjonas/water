<?php

namespace App\Filament\Clusters\Settings\Resources\Donors;

use App\Filament\Clusters\Settings\Resources\Donors\Pages\CreateDonor;
use App\Filament\Clusters\Settings\Resources\Donors\Pages\EditDonor;
use App\Filament\Clusters\Settings\Resources\Donors\Pages\ListDonors;
use App\Filament\Clusters\Settings\Resources\Donors\Pages\ViewDonor;
use App\Filament\Clusters\Settings\Resources\Donors\Schemas\DonorForm;
use App\Filament\Clusters\Settings\Resources\Donors\Schemas\DonorInfolist;
use App\Filament\Clusters\Settings\Resources\Donors\Tables\DonorsTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\Donor;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DonorResource extends Resource
{
    protected static ?string $model = Donor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = SettingsCluster::class;

    protected static ?string $recordTitleAttribute = 'donor_data';

    public static function form(Schema $schema): Schema
    {
        return DonorForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DonorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DonorsTable::configure($table);
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
            'index' => ListDonors::route('/'),
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
