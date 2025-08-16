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
                TextColumn::make('scheme_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('district')
                    ->searchable(),
                TextColumn::make('palika')
                    ->searchable(),
                TextColumn::make('sector')
                    ->searchable(),
                TextColumn::make('sub_schemes')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estimated_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('helvetas_actual')
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
                TextColumn::make('actual_expenditure_total')
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
