<?php

namespace App\Filament\Resources\HouseholdSanitations;

use App\Filament\Resources\HouseholdSanitations\Pages\CreateHouseholdSanitation;
use App\Filament\Resources\HouseholdSanitations\Pages\EditHouseholdSanitation;
use App\Filament\Resources\HouseholdSanitations\Pages\ListHouseholdSanitations;
use App\Filament\Resources\HouseholdSanitations\Pages\ViewHouseholdSanitation;
use App\Filament\Resources\HouseholdSanitations\Schemas\HouseholdSanitationForm;
use App\Filament\Resources\HouseholdSanitations\Schemas\HouseholdSanitationInfolist;
use App\Filament\Resources\HouseholdSanitations\Tables\HouseholdSanitationsTable;
use App\Models\HouseholdSanitation;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HouseholdSanitationResource extends Resource
{
    protected static ?string $model = HouseholdSanitation::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'household_sanitations_data';

    public static function form(Schema $schema): Schema
    {
        return HouseholdSanitationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HouseholdSanitationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HouseholdSanitationsTable::configure($table);
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
            'index' => ListHouseholdSanitations::route('/'),
            'create' => CreateHouseholdSanitation::route('/create'),
            'view' => ViewHouseholdSanitation::route('/{record}'),
            'edit' => EditHouseholdSanitation::route('/{record}/edit'),
        ];
    }
}
