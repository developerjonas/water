<?php

namespace App\Filament\Resources\WaterQualityTests\Tables;

use App\Filament\Components\SchemeColumns;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;
use App\Actions\Pdf\WaterQualityReportGenerator; // Import the new class

class WaterQualityTestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(array_merge(
                SchemeColumns::make(),
                [
                    // --- Test Point ---
                    TextColumn::make('tested_point_name') // Updated column name
                        ->label('Sample Point')
                        ->searchable()
                        ->description(fn($record) => $record->test_date?->format('d M Y') ?? 'No Date')
                        ->weight('bold'),

                    // --- Biological (With Risk Colors) ---
                    TextColumn::make('ecoli')
                        ->label('E.coli')
                        ->numeric()
                        ->sortable()
                        ->badge()
                        ->color(fn($record) => $record->ecoli_color) // Uses Model Accessor
                        ->formatStateUsing(fn($state) => $state . ' CFU'),

                    TextColumn::make('coliform')
                        ->label('Coliform')
                        ->numeric()
                        ->sortable()
                        ->badge()
                        ->color(fn($record) => match (true) {
                            $record->coliform == 0 => 'success',
                            $record->coliform <= 10 => 'info',
                            $record->coliform <= 100 => 'warning',
                            default => 'danger',
                        })
                        ->toggleable(isToggledHiddenByDefault: true),

                    // --- Chemical ---
                    TextColumn::make('ph')
                        ->label('pH')
                        ->numeric()
                        ->sortable()
                        ->color(fn($record) => $record->ph_status === 'Compliant' ? 'success' : 'danger'),

                    TextColumn::make('frc')
                        ->label('FRC')
                        ->numeric()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),

                    TextColumn::make('turbidity')
                        ->label('Turbidity')
                        ->numeric()
                        ->sortable()
                        ->color(fn($record) => $record->turbidity_status === 'Compliant' ? 'success' : 'danger'),

                    // --- Meta ---
                    TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                ]
            ))
            ->filters([
                // Add filters here if needed (e.g., Risk Level)
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),


                Action::make('download_report')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down')
                    ->color('success')
                    ->action(function ($record) {
                        return (new WaterQualityReportGenerator($record))->streamPdf();
                    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}