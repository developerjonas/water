<?php

namespace App\Filament\Resources\Schemes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;



class SchemesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('province')
                    ->searchable(),
                TextColumn::make('district')
                    ->searchable(),
                TextColumn::make('mun')
                    ->searchable(),
                TextColumn::make('ward_no')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('scheme_code')
                    ->searchable(),
                TextColumn::make('scheme_name')
                    ->searchable(),
                TextColumn::make('scheme_name_np')
                    ->searchable(),
                TextColumn::make('sector')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('scheme_technology')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('scheme_type')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('scheme_construction_type')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('scheme_start_year')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('completion_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('agreement_signed_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('schedule_end_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('started_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('planned_completion_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('actual_completed_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('source_registration_status')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('source_conservation')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('no_subscheme')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('progress_status')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('download_pdf')
                    ->label('Download PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->action(function ($record) {
                        $pdf = Pdf::loadView('pdf.scheme', ['scheme' => $record])
                            ->setPaper('A4', 'portrait'); // You can use 'landscape' if needed
            
                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->output();
                        }, 'scheme-' . $record->scheme_code . '.pdf');
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    BulkAction::make('download_csv')
                        ->label('Download CSV')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->action(function ($records) {
                            // Convert to array
                            $data = $records->map(function ($record) {
                                return [
                                    'Scheme Code' => $record->scheme_code,
                                    'Scheme Name (EN)' => $record->scheme_name,
                                    'Scheme Name (NP)' => $record->scheme_name_np,
                                    'Province' => $record->province,
                                    'District' => $record->district,
                                    'Municipality' => $record->mun,
                                    'Ward No.' => $record->ward_no,
                                    'Sector' => $record->sector,
                                    'Technology' => $record->scheme_technology,
                                    'Scheme Type' => $record->scheme_type,
                                    'Construction Type' => $record->scheme_construction_type,
                                    'Start Year' => $record->scheme_start_year,
                                    'Agreement Signed' => $record->agreement_signed_date,
                                    'Started Date' => $record->started_date,
                                    'Planned Completion' => $record->planned_completion_date,
                                    'Actual Completed' => $record->actual_completed_date,
                                    'Progress Status' => $record->progress_status,
                                    'Source Registered' => $record->source_registration_status ? 'Yes' : 'No',
                                    'Source Conservation' => $record->source_conservation ? 'Yes' : 'No',
                                    'No Subscheme' => $record->no_subscheme ? 'Yes' : 'No',
                                ];
                            });

                            // Generate CSV content
                            $handle = fopen('php://temp', 'r+');
                            fputcsv($handle, array_keys($data->first())); // headers
                            foreach ($data as $row) {
                                fputcsv($handle, $row);
                            }
                            rewind($handle);
                            $csv = stream_get_contents($handle);
                            fclose($handle);

                            // Return download response
                            return Response::streamDownload(function () use ($csv) {
                                echo $csv;
                            }, 'schemes-export-' . now()->format('Y-m-d-His') . '.csv');
                        })
                        ->requiresConfirmation()
                        ->color('success'),

                ]),
            ]);
    }
}
