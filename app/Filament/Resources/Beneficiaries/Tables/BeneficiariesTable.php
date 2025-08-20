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
                TextColumn::make('scheme_code')
                    ->searchable(),
                TextColumn::make('dalit_hh_poor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dalit_hh_nonpoor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('aj_hh_poor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('aj_hh_nonpoor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('other_hh_poor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('other_hh_nonpoor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dalit_female')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dalit_male')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('aj_female')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('aj_male')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('others_female')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('others_male')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('base_population')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('boys_student')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('girls_student')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('teachers_staff')
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
