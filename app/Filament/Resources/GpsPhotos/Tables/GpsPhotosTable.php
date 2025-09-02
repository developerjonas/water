<?php

namespace App\Filament\Resources\GpsPhotos\Tables;

use App\Filament\Components\SchemeColumns; // <-- reusable scheme columns
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GpsPhotosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(array_merge(
                SchemeColumns::make(), // <-- replaces scheme_code / scheme_name
                [
                    TextColumn::make('water_system_name')
                        ->searchable(),
                    TextColumn::make('location_type')
                        ->searchable(),
                    TextColumn::make('source_type')
                        ->searchable(),
                    TextColumn::make('hardware_type')
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
                ]
            ))
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(), // <-- added Delete action
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
