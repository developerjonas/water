<?php

namespace App\Filament\Resources\UserCommittees;

use App\Filament\Resources\UserCommittees\Pages\CreateUserCommittee;
use App\Filament\Resources\UserCommittees\Pages\EditUserCommittee;
use App\Filament\Resources\UserCommittees\Pages\ListUserCommittees;
use App\Filament\Resources\UserCommittees\Pages\ViewUserCommittee;
use App\Filament\Resources\UserCommittees\Schemas\UserCommitteeForm;
use App\Filament\Resources\UserCommittees\Schemas\UserCommitteeInfolist;
use App\Filament\Resources\UserCommittees\Tables\UserCommitteesTable;
use App\Models\UserCommittee;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserCommitteeResource extends Resource
{
    protected static ?string $model = UserCommittee::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserGroup;

    protected static ?string $recordTitleAttribute = 'user_committee_data';

    protected static ?string $navigationLabel = "WUSC";


    protected static ?int $navigationSort = 6;


    public static function form(Schema $schema): Schema
    {
        return UserCommitteeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserCommitteeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserCommitteesTable::configure($table);
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
            'index' => ListUserCommittees::route('/'),
            'create' => CreateUserCommittee::route('/create'),
            'view' => ViewUserCommittee::route('/{record}'),
            'edit' => EditUserCommittee::route('/{record}/edit'),
        ];
    }
}
