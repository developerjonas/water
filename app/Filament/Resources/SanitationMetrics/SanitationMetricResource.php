<?php

namespace App\Filament\Resources\SanitationMetrics;

use App\Filament\Resources\SanitationMetrics\Pages\CreateSanitationMetric;
use App\Filament\Resources\SanitationMetrics\Pages\EditSanitationMetric;
use App\Filament\Resources\SanitationMetrics\Pages\ListSanitationMetrics;
use App\Filament\Resources\SanitationMetrics\Pages\ViewSanitationMetric;
use App\Filament\Resources\SanitationMetrics\Schemas\SanitationMetricForm;
use App\Filament\Resources\SanitationMetrics\Schemas\SanitationMetricInfolist;
use App\Filament\Resources\SanitationMetrics\Tables\SanitationMetricsTable;
use App\Models\SanitationMetric;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SanitationMetricResource extends Resource
{
    protected static ?string $model = SanitationMetric::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ShieldCheck;

    protected static ?string $recordTitleAttribute = 'sanitation_data';

        protected static ?int $navigationSort = 7;


    public static function form(Schema $schema): Schema
    {
        return SanitationMetricForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SanitationMetricInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SanitationMetricsTable::configure($table);
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
            'index' => ListSanitationMetrics::route('/'),
            'create' => CreateSanitationMetric::route('/create'),
            'view' => ViewSanitationMetric::route('/{record}'),
            'edit' => EditSanitationMetric::route('/{record}/edit'),
        ];
    }
}
