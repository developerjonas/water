<?php

namespace App\Filament\Resources\WaterPoints\Tables;

use App\Filament\Components\SchemeColumns;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter; // Added Filters
use Filament\Tables\Table;

class WaterPointsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(array_merge(
                SchemeColumns::make(), 
                [
                    // --- Identity ---
                    TextColumn::make('water_point_name')
                        ->searchable()
                        ->weight('bold')
                        ->label('Water Point Name'),
                        
                    TextColumn::make('sub_system_name')
                        ->searchable()
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->label('Sub-System'),

                    // --- Location ---
                    TextColumn::make('ward_no')
                        ->label('Ward')
                        ->sortable()
                        ->badge(),

                    TextColumn::make('tole')
                        ->searchable()
                        ->toggleable(),

                    TextColumn::make('location_type')
                        ->badge()
                        ->color('info')
                        ->searchable(),

                    // --- Social Data (New) ---
                    TextColumn::make('ethnicity')
                        ->toggleable()
                        ->sortable(),

                    TextColumn::make('economic_status')
                        ->label('Eco Status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            'Poor' => 'danger',
                            'Non-Poor' => 'success',
                            default => 'gray',
                        })
                        ->toggleable(),

                    // --- Counts ---
                    TextColumn::make('households_count')
                        ->label('HHs')
                        ->numeric()
                        ->sortable(),

                    TextColumn::make('woman')
                        ->label('F')
                        ->numeric()
                        ->toggleable(isToggledHiddenByDefault: true),
                        
                    TextColumn::make('man')
                        ->label('M')
                        ->numeric()
                        ->toggleable(isToggledHiddenByDefault: true),

                    // --- Status & Media ---
                    TextColumn::make('tap_construction_status')
                        ->label('Built?')
                        ->badge()
                        ->color(fn (string $state): string => $state === 'Yes' || $state === 'yes' ? 'success' : 'warning'),

                    ImageColumn::make('photo_url')
                        ->label('Photo')
                        ->disk('public')
                        ->circular()
                        ->toggleable(),
                ]
            ))
            ->filters([
                SelectFilter::make('location_type')
                    ->options([
                        'Community' => 'Community',
                        'School' => 'School',
                        'Health Post' => 'Health Post',
                    ]),
                SelectFilter::make('ethnicity')
                    ->options([
                        'Dalit' => 'Dalit',
                        'Janjati' => 'Janjati',
                        'Other' => 'Other',
                    ]),
                SelectFilter::make('economic_status')
                    ->label('Poverty Status')
                    ->options([
                        'Poor' => 'Poor',
                        'Non-Poor' => 'Non-Poor',
                    ]),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}