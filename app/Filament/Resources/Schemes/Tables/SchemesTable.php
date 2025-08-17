<?php

namespace App\Filament\Resources\Schemes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class SchemesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('district')
                    ->searchable(),
                TextColumn::make('mun')
                    ->searchable(),
                TextColumn::make('ward_no')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('donor')
                    ->searchable(),
                TextColumn::make('scheme_code')
                    ->searchable(),
                TextColumn::make('scheme_name')
                    ->searchable(),
                TextColumn::make('sector')
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('scheme_technology')
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('scheme_type')
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('scheme_start_year')
                ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('source_registration_status')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('no_subscheme')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('completed_year')
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('completion_date')
                    ->date()
                    ->sortable(),
                IconColumn::make('source_conservation')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('agreement_signed_date')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('schedule_end_date')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('started_date')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('planned_completion_date')
                    ->date()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                TextColumn::make('actual_completed_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('progress_status')
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
