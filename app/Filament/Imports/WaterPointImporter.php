<?php

namespace App\Filament\Imports;

use App\Models\WaterPoint;
use App\Models\Scheme;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class WaterPointImporter extends Importer
{
    protected static ?string $model = WaterPoint::class;

    public static function getColumns(): array
    {
        return [
            // ---------------------------------------------------------
            // 1. THE ROBUST LOOKUP
            // ---------------------------------------------------------
            ImportColumn::make('scheme_code_user') // This is the identifier in the Importer
                ->label('Scheme Code (Map to CSV "Scheme Code")') 
                ->requiredMapping()
                ->fillRecordUsing(function ($record, $state) {
                    
                    // 1. Clean the CSV value
                    $searchCode = Str::squish(trim((string) $state));

                    // 2. Log what we are looking for (Check storage/logs/laravel.log)
                    Log::info("Importing Row: Searching for Scheme with User Code: [{$searchCode}]");

                    // 3. Robust Database Search (Case insensitive + ignores spaces)
                    // We use 'LIKE' to find it even if the DB has hidden spaces
                    $scheme = Scheme::query()
                        ->where('scheme_code_user', 'LIKE', $searchCode)
                        ->orWhere('scheme_code_user', 'LIKE', "%{$searchCode}%")
                        ->first();

                    // 4. Handle Result
                    if ($scheme) {
                        Log::info("FOUND: Linked to System Code: [{$scheme->scheme_code}]");
                        $record->scheme_code = $scheme->scheme_code;
                    } else {
                        Log::error("FAILED: Could not find Scheme for code: [{$searchCode}]");
                        // This specific error message should appear in your failed rows file
                        throw new \Exception("Code '{$searchCode}' not found in Schemes table.");
                    }
                }),

            // ---------------------------------------------------------
            // 2. OTHER COLUMNS
            // ---------------------------------------------------------
            ImportColumn::make('water_point_name')->requiredMapping(),
            ImportColumn::make('location_type'),
            ImportColumn::make('tole'),
            ImportColumn::make('tap_construction_status'),
            
            ImportColumn::make('households_count')->numeric(),
            ImportColumn::make('ethnicity'),
            ImportColumn::make('economic_status'),

            ImportColumn::make('woman')->numeric(),
            ImportColumn::make('man')->numeric(),
            
            ImportColumn::make('total_users')
                ->numeric()
                ->fillRecordUsing(function ($record, $state) {
                    if (is_numeric($state) && $state > 0) {
                        $record->total_users = $state;
                    } else {
                        $record->total_users = (int)$record->man + (int)$record->woman;
                    }
                }),

            ImportColumn::make('remarks'),
        ];
    }

    public function resolveRecord(): WaterPoint
    {
        return new WaterPoint();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        return 'Import completed. ' . Number::format($import->successful_rows) . ' rows processed.';
    }
}