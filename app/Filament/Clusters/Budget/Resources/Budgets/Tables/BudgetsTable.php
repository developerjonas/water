<?php

namespace App\Filament\Clusters\Budget\Resources\Budgets\Tables;

use App\Filament\Components\SchemeColumns;
use App\Actions\Pdf\BudgetReportGenerator; // Import Generator
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action; // Import Action
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BudgetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(array_merge(
                SchemeColumns::make(), 
                [
                    // --- Identity ---
                    TextColumn::make('budget_code')
                        ->label('Ref No.')
                        ->searchable()
                        ->placeholder('-'),

                    // --- Status ---
                    TextColumn::make('budget_status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'draft' => 'gray',
                            'proposed' => 'info',
                            'approved' => 'success',
                            'rejected' => 'danger',
                            'final' => 'primary',
                            default => 'gray',
                        })
                        ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                    // --- Financials ---
                    TextColumn::make('helvetas_estimated_total')
                        ->label('Helvetas Total')
                        ->money('NPR')
                        ->sortable()
                        ->weight('bold'),

                    TextColumn::make('community_contribution')
                        ->label('Community')
                        ->money('NPR')
                        ->toggleable(isToggledHiddenByDefault: true),

                    TextColumn::make('palika_estimated')
                        ->label('Palika')
                        ->money('NPR')
                        ->toggleable(isToggledHiddenByDefault: true),

                    TextColumn::make('total_estimated')
                        ->label('Grand Total')
                        ->money('NPR')
                        ->sortable()
                        ->color('success')
                        ->weight('black'),

                    // --- Meta ---
                    TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                ]
            ))
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                
                // --- PDF Action ---
                Action::make('download_pdf')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function ($record) {
                        return (new BudgetReportGenerator($record))->streamPdf();
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}