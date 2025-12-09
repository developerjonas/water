<?php

namespace App\Filament\Resources\WaterPoints\Tables;

use App\Filament\Components\SchemeColumns;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use App\Actions\Pdf\WaterPointReportGenerator;
use App\Models\WaterPoint;

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

                    TextColumn::make('tole')
                        ->searchable()
                        ->toggleable(isToggledHiddenByDefault: true),
                        
                    TextColumn::make('location_type')
                        ->badge()
                        ->color('info')
                        ->searchable(),

                    TextColumn::make('ethnicity')
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),

                    TextColumn::make('economic_status')
                        ->label('Eco Status')
                        ->badge()->toggleable(isToggledHiddenByDefault: true)
                        ->color(fn(string $state): string => match ($state) {
                            'Poor' => 'danger',
                            'Non-Poor' => 'success',
                            default => 'gray',
                        }),

                    // --- Counts ---
                    TextColumn::make('households_count')
                        ->label('HHs')
                        ->numeric()
                        ->toggleable(isToggledHiddenByDefault: true)
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
                        ->color(fn(string $state): string => $state === 'Yes' || $state === 'yes' ? 'success' : 'warning')->toggleable(isToggledHiddenByDefault: true),

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
                    ])

            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('download_report')
                    ->color('success')
                    ->label('PDF')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function (WaterPoint $record) {
                        return (new WaterPointReportGenerator($record))->streamPdf();
                    }),
                DeleteAction::make()
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}