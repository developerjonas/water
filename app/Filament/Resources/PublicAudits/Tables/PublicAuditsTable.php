<?php

namespace App\Filament\Resources\PublicAudits\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PublicAuditsTable
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
                TextColumn::make('audit_name')
                    ->searchable(),
                TextColumn::make('audit_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('df')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dm')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jf')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jm')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('of')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('om')
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
