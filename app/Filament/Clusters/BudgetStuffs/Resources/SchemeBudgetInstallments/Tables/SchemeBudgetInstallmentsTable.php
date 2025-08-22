<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgetInstallments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SchemeBudgetInstallmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scheme_budget_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('installment_number')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('municipality')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('helvetas_cash')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('helvetas_kd')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('users')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('others')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total')
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
