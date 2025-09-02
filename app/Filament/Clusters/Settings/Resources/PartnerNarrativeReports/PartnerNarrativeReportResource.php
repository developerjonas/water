<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports;

use App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Pages\CreatePartnerNarrativeReport;
use App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Pages\EditPartnerNarrativeReport;
use App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Pages\ListPartnerNarrativeReports;
use App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Pages\ViewPartnerNarrativeReport;
use App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Schemas\PartnerNarrativeReportForm;
use App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Schemas\PartnerNarrativeReportInfolist;
use App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Tables\PartnerNarrativeReportsTable;
use App\Filament\Clusters\Settings\SettingsCluster;
use App\Models\PartnerNarrativeReport;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PartnerNarrativeReportResource extends Resource
{
    protected static ?string $model = PartnerNarrativeReport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

            protected static string | UnitEnum | null $navigationGroup = 'Partner';


    protected static ?string $cluster = SettingsCluster::class;

    protected static ?string $recordTitleAttribute = 'partner_narrative_report_data';

    public static function form(Schema $schema): Schema
    {
        return PartnerNarrativeReportForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PartnerNarrativeReportInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PartnerNarrativeReportsTable::configure($table);
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
            'index' => ListPartnerNarrativeReports::route('/'),
            'create' => CreatePartnerNarrativeReport::route('/create'),
            'view' => ViewPartnerNarrativeReport::route('/{record}'),
            'edit' => EditPartnerNarrativeReport::route('/{record}/edit'),
        ];
    }
}
