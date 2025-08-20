<?php

namespace App\Filament\Resources\Structures\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StructuresTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scheme_code')
                    ->searchable(),
                TextColumn::make('intakes_constructed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('intakes_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rvts_constructed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rvts_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cc_dc_bpt_constructed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cc_dc_bpt_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('other_structures_constructed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('other_structures_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('public_taps')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('school_taps')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('private_taps')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('taps_constructed_progress')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('taps_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('transmission_line_progress')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('transmission_line_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('distribution_line_progress')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('distribution_line_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('private_line_progress')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('private_line_remaining')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('mb_submitted_to_municipality')
                    ->boolean(),
                IconColumn::make('municipality_contribution_transferred')
                    ->boolean(),
                IconColumn::make('public_hearing_done')
                    ->boolean(),
                IconColumn::make('public_review_done')
                    ->boolean(),
                IconColumn::make('final_public_audit_done')
                    ->boolean(),
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
