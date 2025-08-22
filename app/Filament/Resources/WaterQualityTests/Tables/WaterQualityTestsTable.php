<?php

namespace App\Filament\Resources\WaterQualityTests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;
use App\Actions\Pdf\PdfExporter;


class WaterQualityTestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scheme_code')
                    ->searchable(),
                TextColumn::make('tested_point')
                    ->searchable(),
                TextColumn::make('ecoli')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('coliform')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('ph')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('frc')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('turbidity')
                    ->numeric()
                    ->sortable(),
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
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('download_pdf')
                    ->label('Download PDF')
                    ->icon('heroicon-o-arrow-down')
                    ->action(function ($record) {
                        return (new PdfExporter('pdf.water_quality'))
                            ->setData(['data' => $record])
                            ->setFilename('water-quality-' . $record->id . '.pdf')
                            ->download();
                    })
                    ->color('primary'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
