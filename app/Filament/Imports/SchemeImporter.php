<?php

namespace App\Filament\Imports;

use App\Models\Scheme;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class SchemeImporter extends Importer
{
    protected static ?string $model = Scheme::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('province')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('district')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('mun')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('ward_no')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            
            ImportColumn::make('scheme_code_user')
                ->rules(['max:255']),
            ImportColumn::make('scheme_name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('scheme_name_np')
                ->rules(['max:255']),
            ImportColumn::make('collaborator'),
            ImportColumn::make('sector')
                ->rules(['max:255']),
            ImportColumn::make('scheme_technology')
                ->rules(['max:255']),
            ImportColumn::make('scheme_type')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('scheme_construction_type')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('scheme_start_year')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('completion_date')
                ->rules(['date']),
            ImportColumn::make('agreement_signed_date')
                ->rules(['date']),
            ImportColumn::make('schedule_end_date')
                ->rules(['date']),
            ImportColumn::make('started_date')
                ->rules(['date']),
            ImportColumn::make('planned_completion_date')
                ->rules(['date']),
            ImportColumn::make('actual_completed_date')
                ->rules(['date']),
            ImportColumn::make('source_registration_status')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('source_conservation')
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            ImportColumn::make('progress_status')
                ->rules(['max:255']),
            ImportColumn::make('justification_for_delay'),
        ];
    }

    public function resolveRecord(): Scheme
    {
        return new Scheme();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your scheme import has completed and ' . Number::format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
