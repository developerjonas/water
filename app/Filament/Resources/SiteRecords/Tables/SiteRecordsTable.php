<?php

namespace App\Filament\Resources\SiteRecords\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SiteRecordsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scheme_code')
                    ->searchable(),
                TextColumn::make('scheme_name')
                    ->searchable(),
                TextColumn::make('water_system_name')
                    ->searchable(),
                TextColumn::make('location_type')
                    ->searchable(),
                TextColumn::make('water_point_name')
                    ->searchable(),
                TextColumn::make('source_details')
                    ->searchable(),
                TextColumn::make('hardware_details')
                    ->searchable(),
                TextColumn::make('plaque_photo')
                    ->searchable(),
                TextColumn::make('latitude')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('longitude')
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
