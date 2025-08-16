<?php

namespace App\Filament\Resources\Maintenances\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MaintenancesTable
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
                TextColumn::make('donor')
                    ->searchable(),
                TextColumn::make('scheme_start_year')
                    ->searchable(),
                TextColumn::make('scheme_name')
                    ->searchable(),
                TextColumn::make('bank_name')
                    ->searchable(),
                TextColumn::make('account_no')
                    ->searchable(),
                TextColumn::make('account_name')
                    ->searchable(),
                TextColumn::make('fund_collected_last_year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fund_collection_per_hh')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_fund_collection_this_year')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_fund_till_date')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('expenditure_till_date')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('hh_beneficiaries')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_taps')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('maintenance_fund_per_tap')
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
