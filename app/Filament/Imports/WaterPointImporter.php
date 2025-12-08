<?php

namespace App\Filament\Imports;

use App\Models\WaterPoint;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class WaterPointImporter extends Importer
{
    protected static ?string $model = WaterPoint::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('scheme_code')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('water_point_name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('location_type')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('tole')
                ->rules(['max:255']),
            ImportColumn::make('ward_no')
                ->rules(['max:255']),
            ImportColumn::make('tap_construction_status')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('households_count')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('ethnicity')
                ->rules(['max:255']),
            ImportColumn::make('economic_status')
                ->rules(['max:255']),
            ImportColumn::make('woman')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('man')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('total_users')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('remarks'),
        ];
    }

    public function resolveRecord(): WaterPoint
    {
        return new WaterPoint();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your water point import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
