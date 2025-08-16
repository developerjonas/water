<?php

namespace App\Filament\Resources\Beneficiaries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BeneficiariesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('district')
                    ->searchable(),
                TextColumn::make('palika')
                    ->searchable(),
                TextColumn::make('scheme_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('sector')
                    ->searchable(),
                TextColumn::make('sub_schemes')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_female')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_male')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_beneficiaries')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('schools')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('taps_provided')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('boys_students')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('girls_students')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('teachers')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_population')
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
