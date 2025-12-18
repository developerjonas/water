<?php

namespace App\Filament\Resources\PublicAudits\Tables;

use App\Filament\Components\SchemeColumns;
use App\Actions\Pdf\PublicAuditReportGenerator; // Import Generator
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action; // Import Action

class PublicAuditsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(array_merge(
                SchemeColumns::make(), 
                [
                    TextColumn::make('audit_type')
                        ->searchable()
                        ->badge()
                        ->color('info'),

                    TextColumn::make('audit_date')
                        ->date()
                        ->sortable(),

                    // Aggregated Total Column (Calculated on the fly for the table view)
                    TextColumn::make('total_participants')
                        ->label('Total Participants')
                        ->state(function ($record) {
                            $counts = $record->participant_counts ?? [];
                            $sum = 0;
                            foreach($counts as $val) { $sum += (int)$val; }
                            return $sum;
                        })
                        ->numeric()
                        ->sortable(false),

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
                    ->icon('heroicon-o-arrow-down')
                    ->color('success')
                    ->action(function ($record) {
                        return (new PublicAuditReportGenerator($record))->streamPdf();
                    }),

                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}