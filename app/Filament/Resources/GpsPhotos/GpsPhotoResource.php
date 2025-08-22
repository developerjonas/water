<?php

namespace App\Filament\Resources\GpsPhotos;

use App\Filament\Resources\GpsPhotos\Pages\CreateGpsPhoto;
use App\Filament\Resources\GpsPhotos\Pages\EditGpsPhoto;
use App\Filament\Resources\GpsPhotos\Pages\ListGpsPhotos;
use App\Filament\Resources\GpsPhotos\Pages\ViewGpsPhoto;
use App\Filament\Resources\GpsPhotos\Schemas\GpsPhotoForm;
use App\Filament\Resources\GpsPhotos\Schemas\GpsPhotoInfolist;
use App\Filament\Resources\GpsPhotos\Tables\GpsPhotosTable;
use App\Models\GpsPhoto;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GpsPhotoResource extends Resource
{
    protected static ?string $model = GpsPhoto::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::MapPin;

    protected static ?string $recordTitleAttribute = 'gps_and_photos';

    protected static ?int $navigationSort = 9;
    protected static ?string $navigationLabel = "Photo & GPS";

    public static function form(Schema $schema): Schema
    {
        return GpsPhotoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return GpsPhotoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GpsPhotosTable::configure($table);
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
            'index' => ListGpsPhotos::route('/'),
            'create' => CreateGpsPhoto::route('/create'),
            'view' => ViewGpsPhoto::route('/{record}'),
            'edit' => EditGpsPhoto::route('/{record}/edit'),
        ];
    }
}
