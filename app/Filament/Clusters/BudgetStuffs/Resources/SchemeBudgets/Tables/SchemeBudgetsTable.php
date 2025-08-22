<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchemeBudgetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scheme_code')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sub_schemes')
                    ->searchable(),
                TextColumn::make('estimated_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estimated_helvetas_cash')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estimated_helvetas_kd')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estimated_municipality')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estimated_users')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estimated_others')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estimated_total')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('actual_amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('actual_helvetas_cash')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('actual_helvetas_kd')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('actual_municipality')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('actual_users')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('actual_others')
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
