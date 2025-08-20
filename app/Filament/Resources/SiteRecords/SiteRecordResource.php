<?php

namespace App\Filament\Resources\SiteRecords;

use App\Filament\Resources\SiteRecords\Pages\CreateSiteRecord;
use App\Filament\Resources\SiteRecords\Pages\EditSiteRecord;
use App\Filament\Resources\SiteRecords\Pages\ListSiteRecords;
use App\Filament\Resources\SiteRecords\Pages\ViewSiteRecord;
use App\Filament\Resources\SiteRecords\Schemas\SiteRecordForm;
use App\Filament\Resources\SiteRecords\Schemas\SiteRecordInfolist;
use App\Filament\Resources\SiteRecords\Tables\SiteRecordsTable;
use App\Models\SiteRecord;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;


class SiteRecordResource extends Resource
{
    protected static ?string $model = SiteRecord::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'site_data';

    public static function form(Schema $schema): Schema
    {
        return SiteRecordForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SiteRecordInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SiteRecordsTable::configure($table);
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
            'index' => ListSiteRecords::route('/'),
            'create' => CreateSiteRecord::route('/create'),
            'view' => ViewSiteRecord::route('/{record}'),
            'edit' => EditSiteRecord::route('/{record}/edit'),
        ];
    }
}
