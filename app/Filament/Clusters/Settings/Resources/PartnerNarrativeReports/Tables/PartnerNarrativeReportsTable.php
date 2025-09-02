<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerNarrativeReports\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Table;

class PartnerNarrativeReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('partner.name') // Show Partner Name instead of ID
                    ->label('Partner')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('reporting_period')
                    ->label('Reporting Period')
                    ->sortable()
                    ->searchable(),

                TagsColumn::make('report_files') // Show files as clickable tags
                    ->label('Files')
                    ->url(fn ($record, $file) => asset('storage/' . $file), true) // Opens in new tab
                    ->limit(3) // Show max 3 files, then "+X more"

                    ->separator(', ')
                    ->badge(), // Makes them look nice

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // You can add filters like "By Partner" or "By Period"
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
