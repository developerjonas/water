<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerStaff;

use App\Filament\Clusters\Settings\Resources\PartnerStaff\Pages\CreatePartnerStaff;
use App\Filament\Clusters\Settings\Resources\PartnerStaff\Pages\EditPartnerStaff;
use App\Filament\Clusters\Settings\Resources\PartnerStaff\Pages\ListPartnerStaff;
use App\Filament\Clusters\Settings\Resources\PartnerStaff\Pages\ViewPartnerStaff;
use App\Filament\Clusters\Settings\Resources\PartnerStaff\Schemas\PartnerStaffForm;
use App\Filament\Clusters\Settings\Resources\PartnerStaff\Schemas\PartnerStaffInfolist;
use App\Filament\Clusters\Settings\Resources\PartnerStaff\Tables\PartnerStaffTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\PartnerStaff;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PartnerStaffResource extends Resource
{
    protected static ?string $model = PartnerStaff::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

            protected static string | UnitEnum | null $navigationGroup = 'Partner';


    protected static ?string $cluster = SettingsCluster::class;

    protected static ?string $recordTitleAttribute = 'partner_staff_data';

    public static function form(Schema $schema): Schema
    {
        return PartnerStaffForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PartnerStaffInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PartnerStaffTable::configure($table);
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
            'index' => ListPartnerStaff::route('/'),
            'create' => CreatePartnerStaff::route('/create'),
            'view' => ViewPartnerStaff::route('/{record}'),
            'edit' => EditPartnerStaff::route('/{record}/edit'),
        ];
    }
}
