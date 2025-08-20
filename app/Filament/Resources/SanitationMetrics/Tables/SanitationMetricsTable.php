<?php

namespace App\Filament\Resources\SanitationMetrics\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SanitationMetricsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scheme_code')
                    ->searchable(),
                TextColumn::make('households_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('households_with_toilet')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('households_with_drying_rack')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('households_with_handwashing_station')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('households_using_filter')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('households_with_waste_disposal_pit')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_sanitation_status')
                    ->searchable(),
                TextColumn::make('remarks')
                    ->searchable(),
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
