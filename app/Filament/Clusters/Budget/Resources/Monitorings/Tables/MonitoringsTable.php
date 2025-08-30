<?php

namespace App\Filament\Clusters\Budget\Resources\Monitorings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MonitoringsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('monitoring_code')
                    ->label('Monitoring Code')
                    ->copyable()
                    ->searchable(),

                TextColumn::make('scheme_code')
                    ->label('Scheme Code')
                    ->searchable(),

                TextColumn::make('budget_code')
                    ->label('Budget Code')
                    ->searchable(),

                TextColumn::make('monitored_by')
                    ->label('Monitored By')
                    ->searchable(),

                TextColumn::make('monitoring_date')
                    ->label('Monitoring Date')
                    ->date()
                    ->sortable(),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'gray' => 'pending',
                        'warning' => 'in_progress',
                        'success' => 'completed',
                        'danger' => 'issues_found',
                    ])
                    ->sortable(),

                TextColumn::make('remarks')
                    ->label('Remarks')
                    ->limit(50)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'issues_found' => 'Issues Found',
                    ]),
                SelectFilter::make('scheme_code')
                    ->label('Scheme')
                    ->relationship('scheme', 'scheme_code'),
                SelectFilter::make('budget_code')
                    ->label('Budget')
                    ->relationship('budget', 'budget_code'),
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
