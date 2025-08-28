<?php

namespace App\Filament\Clusters\Settings\Resources\HelpDocs;

use App\Filament\Clusters\Settings\Resources\HelpDocs\Pages\CreateHelpDoc;
use App\Filament\Clusters\Settings\Resources\HelpDocs\Pages\EditHelpDoc;
use App\Filament\Clusters\Settings\Resources\HelpDocs\Pages\ListHelpDocs;
use App\Filament\Clusters\Settings\Resources\HelpDocs\Pages\ViewHelpDoc;
use App\Filament\Clusters\Settings\Resources\HelpDocs\Schemas\HelpDocForm;
use App\Filament\Clusters\Settings\Resources\HelpDocs\Schemas\HelpDocInfolist;
use App\Filament\Clusters\Settings\Resources\HelpDocs\Tables\HelpDocsTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\HelpDoc;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HelpDocResource extends Resource
{
    protected static ?string $model = HelpDoc::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $cluster = SettingsCluster::class;

    protected static ?string $recordTitleAttribute = 'helo_docs_data';

    public static function form(Schema $schema): Schema
    {
        return HelpDocForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return HelpDocInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HelpDocsTable::configure($table);
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
            'index' => ListHelpDocs::route('/'),
            'create' => CreateHelpDoc::route('/create'),
            'view' => ViewHelpDoc::route('/{record}'),
            'edit' => EditHelpDoc::route('/{record}/edit'),
        ];
    }
}
