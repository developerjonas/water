<?php

namespace App\Filament\Clusters\Settings\Resources\Partners;

use App\Filament\Clusters\Settings\Resources\Partners\Pages\CreatePartner;
use App\Filament\Clusters\Settings\Resources\Partners\Pages\EditPartner;
use App\Filament\Clusters\Settings\Resources\Partners\Pages\ListPartners;
use App\Filament\Clusters\Settings\Resources\Partners\Pages\ViewPartner;
use App\Filament\Clusters\Settings\Resources\Partners\Schemas\PartnerForm;
use App\Filament\Clusters\Settings\Resources\Partners\Schemas\PartnerInfolist;
use App\Filament\Clusters\Settings\Resources\Partners\Tables\PartnersTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\Partner;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = SettingsCluster::class;

    protected static ?string $recordTitleAttribute = 'parttner_data';

    public static function form(Schema $schema): Schema
    {
        return PartnerForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PartnerInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PartnersTable::configure($table);
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
            'index' => ListPartners::route('/'),
            'create' => CreatePartner::route('/create'),
            'view' => ViewPartner::route('/{record}'),
            'edit' => EditPartner::route('/{record}/edit'),
        ];
    }
}
