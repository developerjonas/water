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
            // -------------------
            // Location / Address
            // -------------------
            ImportColumn::make('province')
                ->requiredMapping()
                ->rules(['required', 'max:255']),

            ImportColumn::make('district')
                ->requiredMapping()
                ->rules(['required', 'max:255']),

            ImportColumn::make('mun')
                ->label('Municipality')
                ->requiredMapping()
                ->rules(['required', 'max:255']),

            ImportColumn::make('ward_no')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),

            // -------------------
            // Identification
            // -------------------

            ImportColumn::make('scheme_code_user')
                ->label('User Code')
                ->rules(['max:255']),

            ImportColumn::make('scheme_name')
                ->requiredMapping()
                ->rules(['required', 'max:255']),

            ImportColumn::make('scheme_name_np')->rules(['nullable', 'max:255']),

            // -------------------
            // Sub Schemes
            // -------------------
            ImportColumn::make('no_of_sub_schemes')
                ->numeric()
                ->rules(['integer', 'min:0', 'nullable']),

            // -------------------
            // Collaborator
            // -------------------
            ImportColumn::make('collaborator')
                ->label('Collaborator (JSON/Text)'),

            // -------------------
            // Type & Classification
            // -------------------
            ImportColumn::make('scheme_sector')->rules(['nullable', 'max:255']),

            ImportColumn::make('scheme_construction_type')
                ->requiredMapping()
                ->rules(['required', 'max:255']),

            ImportColumn::make('scheme_technology')->rules(['nullable', 'max:255']),

            // -------------------
            // Timing & Dates
            // -------------------
            ImportColumn::make('started_date')->rules(['nullable', 'date']),
            ImportColumn::make('planned_completion_date')->rules(['nullable', 'date']),
            ImportColumn::make('actual_completed_date')->rules(['nullable', 'date']),

            // -------------------
            // Status Flags
            // -------------------
            ImportColumn::make('source_registration_status')
                ->boolean()
                ->rules(['boolean']),

            ImportColumn::make('source_conservation')
                ->boolean()
                ->rules(['boolean']),

            ImportColumn::make('progress_status')->rules(['nullable', 'max:255']),

            ImportColumn::make('justification_for_delay'),
        ];
    }

    public function resolveRecord(): ?Scheme
    {
     

        // 2. Otherwise, create a NEW record (Model handles ID generation).
        return new Scheme();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        return 'Import completed. ' . Number::format($import->successful_rows) . ' rows processed.';
    }
}