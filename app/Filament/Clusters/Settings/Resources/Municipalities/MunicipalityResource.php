<?php

namespace App\Filament\Clusters\Settings\Resources\Municipalities;

use App\Filament\Clusters\Settings\Resources\Municipalities\Pages\CreateMunicipality;
use App\Filament\Clusters\Settings\Resources\Municipalities\Pages\EditMunicipality;
use App\Filament\Clusters\Settings\Resources\Municipalities\Pages\ListMunicipalities;
use App\Filament\Clusters\Settings\Resources\Municipalities\Pages\ViewMunicipality;
use App\Filament\Clusters\Settings\Resources\Municipalities\Schemas\MunicipalityForm;
use App\Filament\Clusters\Settings\Resources\Municipalities\Schemas\MunicipalityInfolist;
use App\Filament\Clusters\Settings\Resources\Municipalities\Tables\MunicipalitiesTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\Municipality;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class MunicipalityResource extends Resource
{
    protected static ?string $model = Municipality::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

        protected static string | UnitEnum | null $navigationGroup = 'Location';
    protected static bool $navigationGroupCollapsible = false; // NON-collapsible


    protected static ?string $cluster = SettingsCluster::class;

    protected static ?string $recordTitleAttribute = 'municipality_data';

    public static function form(Schema $schema): Schema
    {
        return MunicipalityForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MunicipalityInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MunicipalitiesTable::configure($table);
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
            'index' => ListMunicipalities::route('/'),
            'view' => ViewMunicipality::route('/{record}'),
        ];
    }

      public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user->hasRole(UserRole::ADMIN);
    }
}
