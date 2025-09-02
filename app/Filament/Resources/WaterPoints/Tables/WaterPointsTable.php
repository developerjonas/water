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
                    TextColumn::make('sub_system_name')->searchable()->label('Sub-System / Sub-Scheme Name'),
                    TextColumn::make('location_type')->searchable()->label('Location Type'),
                    TextColumn::make('water_point_name')->searchable()->label('Water Point Name'),
                    TextColumn::make('woman')->numeric()->label('Female'),
                    TextColumn::make('man')->numeric()->label('Male'),
                    TextColumn::make('tap_construction_status')->label('Tap Construction Status'),

                    ImageColumn::make('photo_url')
                        ->label('Photo')
                        ->disk('public')
                        ->height(32)
                        ->width(32)
                        ->toggleable(),

                    TextColumn::make('latitude')->numeric()->sortable(),
                    TextColumn::make('longitude')->numeric()->sortable(),

                    TextColumn::make('remarks')->label('Remarks')->limit(50)->wrap(),

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
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
