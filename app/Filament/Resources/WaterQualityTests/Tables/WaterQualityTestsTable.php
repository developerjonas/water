<?php

namespace App\Filament\Resources\WaterQualityTests\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class WaterQualityTestsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scheme_code')
                    ->searchable(),
                TextColumn::make('water_quality_tested_point_name')
                    ->searchable(),
                TextColumn::make('e_coli')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('coliform')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('ph')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('frc')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('turbidity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('e_coli_risk_category')
                    ->searchable(),
                TextColumn::make('e_coli_risk_zone')
                    ->searchable(),
                TextColumn::make('coliform_risk_category')
                    ->searchable(),
                TextColumn::make('coliform_risk_zone')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
