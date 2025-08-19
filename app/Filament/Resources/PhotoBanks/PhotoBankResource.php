<?php

namespace App\Filament\Resources\PhotoBanks;

use App\Filament\Resources\PhotoBanks\Pages\CreatePhotoBank;
use App\Filament\Resources\PhotoBanks\Pages\EditPhotoBank;
use App\Filament\Resources\PhotoBanks\Pages\ListPhotoBanks;
use App\Filament\Resources\PhotoBanks\Pages\ViewPhotoBank;
use App\Filament\Resources\PhotoBanks\Schemas\PhotoBankForm;
use App\Filament\Resources\PhotoBanks\Schemas\PhotoBankInfolist;
use App\Filament\Resources\PhotoBanks\Tables\PhotoBanksTable;
use App\Models\PhotoBank;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Htmlable;

class PhotoBankResource extends Resource
{
    protected static ?string $model = PhotoBank::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Photo;

    public static function getRecordTitle(?Model $record): string|Htmlable|null
{
    if (!$record) {
        return null;
    }

    return $record->water_system_name
        . ($record->water_point_name ? ' - ' . $record->water_point_name : '');
}

    

    public static function form(Schema $schema): Schema
    {
        return PhotoBankForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PhotoBankInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PhotoBanksTable::configure($table);
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
            'index' => ListPhotoBanks::route('/'),
            'create' => CreatePhotoBank::route('/create'),
            'view' => ViewPhotoBank::route('/{record}'),
            'edit' => EditPhotoBank::route('/{record}/edit'),
        ];
    }
}
