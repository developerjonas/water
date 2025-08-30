<?php

namespace App\Filament\Clusters\Budget\Resources\Budgets\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Layout;
use Filament\Tables\Filters\DateFilter;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Table;

class BudgetsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scheme_code')
                    ->label('Scheme Code')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('budget_code')
                    ->label('Budget Code')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('budget_status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'primary' => 'draft',
                        'warning' => 'finalized',
                        'success' => 'verified',
                    ])
                    ->sortable(),

                TextColumn::make('total_estimated')
                    ->label('Total Estimated')
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),

                TextColumn::make('total_actual')
                    ->label('Total Actual')
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('Y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('Y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('budget_status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'finalized' => 'Finalized',
                        'verified' => 'Verified / Ready for Monitoring',
                    ]),

                Filter::make('high_variance')
                    ->label('High Variance')
                    ->query(fn ($query) => 
                        $query->whereRaw('ABS(total_estimated - total_actual) > 10000')
                    ),

                Filter::make('created_at')
                    ->label('Created Date'),
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
