<?php

namespace App\Filament\Resources\WaterPoints\Tables;

use App\Filament\Components\SchemeColumns; // <-- reusable scheme columns
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class WaterPointsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(array_merge(
                SchemeColumns::make(), // <-- replaces scheme_code
                [
                    TextColumn::make('district')->searchable(),
                    TextColumn::make('palika')->searchable(),
                    TextColumn::make('municipality')->searchable(),
                    TextColumn::make('ward_no')->numeric()->label('Ward No.'),
                    TextColumn::make('water_system_name')->searchable(),
                    TextColumn::make('sub_system')->label('Sub-System'),
                    TextColumn::make('community_name')->label('Community Name'),
                    TextColumn::make('location_type')->searchable(),
                    TextColumn::make('water_point_name')->searchable(),

                    TextColumn::make('population_stats')
                        ->label('Population & Users')
                        ->formatStateUsing(fn($state, $record) =>
                            "HH: {$record->hh}, Taps: {$record->taps}, Pop: {$record->population}, " .
                            "Total Users: {$record->total_water_users}, Unique Users: {$record->unique_water_users}, " .
                            "Schools: {$record->schools}, Students: {$record->students}, " .
                            "Health Centers: {$record->health_centers}, Healthposts: {$record->healthposts}"
                        ),

                    ImageColumn::make('photo_url')
                        ->label('Photo')
                        ->disk('public')
                        ->height(32)
                        ->width(32)
                        ->toggleable(),

                    TextColumn::make('latitude')->numeric()->sortable(),
                    TextColumn::make('longitude')->numeric()->sortable(),

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
