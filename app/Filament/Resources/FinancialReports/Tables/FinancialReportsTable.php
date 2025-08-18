<?php

namespace App\Filament\Resources\FinancialReports\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FinancialReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scheme_code')
                    ->searchable(),
                TextColumn::make('helvetas_estimated_cash')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('helvetas_estimated_kd')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rms_estimated')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('users_estimated')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('others_estimated')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estimated_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('helvetas_actual_cash')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('helvetas_actual_kd')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rms_actual')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('users_actual')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('others_actual')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('actual_total')
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
