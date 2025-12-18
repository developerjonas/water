<?php

namespace App\Filament\Resources\Trainings\Tables;

use App\Filament\Components\SchemeColumns; // <-- reusable scheme columns
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class TrainingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns(array_merge(
                SchemeColumns::make(), // <-- replaces scheme_id
                [
                    TextColumn::make('training_type')
                        ->searchable(),
                    TextColumn::make('training_name')
                        ->searchable(),
                    TextColumn::make('training_start_date')
                        ->date()
                        ->sortable(),
                    TextColumn::make('training_end_date')
                        ->date()
                        ->sortable(),
                    TextColumn::make('training_days')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('training_place')
                        ->searchable(),
                    TextColumn::make('facilitator_name')
                        ->searchable(),
                    TextColumn::make('num_participating_schools')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('teacher_count')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('child_club_count')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('school_mgmt_committee_count')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('dalit_male')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('dalit_female')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('dalit_total')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('janjati_male')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('janjati_female')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('janjati_total')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('other_male')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('other_female')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('other_total')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('male_total')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('female_total')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('total')
                        ->numeric()
                        ->sortable(),
                    TextColumn::make('num_schemes_participants')
                        ->numeric()
                        ->sortable(),
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
                ]
            ))
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
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
