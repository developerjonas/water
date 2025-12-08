<?php

namespace App\Filament\Clusters\Budget\Resources\Budgets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BudgetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scheme_code')
                    ->searchable(),
                TextColumn::make('budget_code')
                    ->searchable(),
                TextColumn::make('helvetas_estimated_cash')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('helvetas_estimated_kind')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('helvetas_estimated_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('community_contribution')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('palika_estimated')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_estimated')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('budget_status')
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
