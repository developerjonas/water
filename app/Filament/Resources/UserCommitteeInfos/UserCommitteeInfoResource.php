<?php

namespace App\Filament\Resources\UserCommitteeInfos;

use App\Filament\Resources\UserCommitteeInfos\Pages\CreateUserCommitteeInfo;
use App\Filament\Resources\UserCommitteeInfos\Pages\EditUserCommitteeInfo;
use App\Filament\Resources\UserCommitteeInfos\Pages\ListUserCommitteeInfos;
use App\Filament\Resources\UserCommitteeInfos\Pages\ViewUserCommitteeInfo;
use App\Filament\Resources\UserCommitteeInfos\Schemas\UserCommitteeInfoForm;
use App\Filament\Resources\UserCommitteeInfos\Schemas\UserCommitteeInfoInfolist;
use App\Filament\Resources\UserCommitteeInfos\Tables\UserCommitteeInfosTable;
use App\Models\UserCommitteeInfo;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserCommitteeInfoResource extends Resource
{
    protected static ?string $model = UserCommitteeInfo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'user_committee_info';

    public static function form(Schema $schema): Schema
    {
        return UserCommitteeInfoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserCommitteeInfoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserCommitteeInfosTable::configure($table);
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
            'index' => ListUserCommitteeInfos::route('/'),
            'create' => CreateUserCommitteeInfo::route('/create'),
            'view' => ViewUserCommitteeInfo::route('/{record}'),
            'edit' => EditUserCommitteeInfo::route('/{record}/edit'),
        ];
    }
}
