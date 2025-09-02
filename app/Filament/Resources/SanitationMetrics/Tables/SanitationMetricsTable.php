<?php

namespace App\Filament\Resources\SanitationMetrics\Tables;

use App\Filament\Components\SchemeColumns; // <-- reusable scheme columns
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;// <-- reusable row actions
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SanitationMetricsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(array_merge(
                SchemeColumns::make(), // <-- replaced scheme_code with province/district/municipality/scheme name
                [
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
                ]
            ))
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ViewAction::make(),
            ]) // <-- reusable actions: view, edit, delete
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
