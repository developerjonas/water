<?php

namespace App\Filament\Resources\PublicAudits;

use App\Filament\Resources\PublicAudits\Pages\CreatePublicAudit;
use App\Filament\Resources\PublicAudits\Pages\EditPublicAudit;
use App\Filament\Resources\PublicAudits\Pages\ListPublicAudits;
use App\Filament\Resources\PublicAudits\Pages\ViewPublicAudit;
use App\Filament\Resources\PublicAudits\Schemas\PublicAuditForm;
use App\Filament\Resources\PublicAudits\Schemas\PublicAuditInfolist;
use App\Filament\Resources\PublicAudits\Tables\PublicAuditsTable;
use App\Models\PublicAudit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PublicAuditResource extends Resource
{
    protected static ?string $model = PublicAudit::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::DocumentChartBar;

    protected static ?string $recordTitleAttribute = 'public_audit_data';

    protected static ?int $navigationSort = 10;

    public static function form(Schema $schema): Schema
    {
        return PublicAuditForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PublicAuditInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PublicAuditsTable::configure($table);
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
            'index' => ListPublicAudits::route('/'),
            'create' => CreatePublicAudit::route('/create'),
            'view' => ViewPublicAudit::route('/{record}'),
            'edit' => EditPublicAudit::route('/{record}/edit'),
        ];
    }
}
