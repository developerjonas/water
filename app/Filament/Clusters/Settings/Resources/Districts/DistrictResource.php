<?php

namespace App\Filament\Clusters\Settings\Resources\Districts;

use App\Filament\Clusters\Settings\Resources\Districts\Pages\CreateDistrict;
use App\Filament\Clusters\Settings\Resources\Districts\Pages\EditDistrict;
use App\Filament\Clusters\Settings\Resources\Districts\Pages\ListDistricts;
use App\Filament\Clusters\Settings\Resources\Districts\Pages\ViewDistrict;
use App\Filament\Clusters\Settings\Resources\Districts\Schemas\DistrictForm;
use App\Filament\Clusters\Settings\Resources\Districts\Schemas\DistrictInfolist;
use App\Filament\Clusters\Settings\Resources\Districts\Tables\DistrictsTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\District;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class DistrictResource extends Resource
{
    protected static ?string $model = District::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Location';

    protected static bool $navigationGroupCollapsible = false; // NON-collapsible

    protected static ?string $cluster = SettingsCluster::class;

    protected static ?string $recordTitleAttribute = 'district_data';

    public static function form(Schema $schema): Schema
    {
        return DistrictForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DistrictInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DistrictsTable::configure($table);
    }

    public static function canCreate(): bool
    {
        return false; // disable creating new provinces
    }

    public static function canDelete(Model $record): bool
    {
        return false; // disable deletion
    }

    public static function canEdit(Model $record): bool
    {
        return true; // allow editing, but we’ll restrict fields
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
            'index' => ListDistricts::route('/'),
            'view' => ViewDistrict::route('/{record}'),
        ];
    }

      public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user->hasRole(UserRole::ADMIN);
    }
}
