<?php

namespace App\Filament\Resources\HouseholdSanitations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HouseholdSanitationsTable
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
                TextColumn::make('hh_beneficiaries')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('hh_having_toilets')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('hh_having_chang')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('hh_having_handwash_station')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('hh_having_filter')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('hh_having_waste_disposal_system')
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
