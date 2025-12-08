<?php

namespace App\Filament\Clusters\Settings\Resources\Provinces;

use App\Filament\Clusters\Settings\Resources\Provinces\Pages\CreateProvince;
use App\Filament\Clusters\Settings\Resources\Provinces\Pages\EditProvince;
use App\Filament\Clusters\Settings\Resources\Provinces\Pages\ListProvinces;
use App\Filament\Clusters\Settings\Resources\Provinces\Pages\ViewProvince;
use App\Filament\Clusters\Settings\Resources\Provinces\Schemas\ProvinceForm;
use App\Filament\Clusters\Settings\Resources\Provinces\Schemas\ProvinceInfolist;
use App\Filament\Clusters\Settings\Resources\Provinces\Tables\ProvincesTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\Province;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class ProvinceResource extends Resource
{
    protected static ?string $model = Province::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | UnitEnum | null $navigationGroup = 'Location';

    protected static bool $navigationGroupCollapsible = false; // NON-collapsible


    protected static ?string $cluster = SettingsCluster::class;

    protected static ?string $recordTitleAttribute = 'province_data';

    public static function form(Schema $schema): Schema
    {
        return ProvinceForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProvinceInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProvincesTable::configure($table);
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
            'index' => ListProvinces::route('/'),
            'view' => ViewProvince::route('/{record}'),
        ];
    }

      public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user->hasRole(UserRole::ADMIN);
    }
}
