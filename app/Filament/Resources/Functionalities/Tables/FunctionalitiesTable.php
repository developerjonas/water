<?php

namespace App\Filament\Resources\Functionalities\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FunctionalitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('province')
                    ->searchable(),
                TextColumn::make('district')
                    ->searchable(),
                TextColumn::make('municipality')
                    ->searchable(),
                TextColumn::make('ward_no')
                    ->searchable(),
                TextColumn::make('scheme_year')
                    ->searchable(),
                TextColumn::make('scheme_completion_date')
                    ->searchable(),
                TextColumn::make('female_members')
                    ->searchable(),
                TextColumn::make('male_members')
                    ->searchable(),
                TextColumn::make('total_members')
                    ->searchable(),
                TextColumn::make('janjati_members')
                    ->searchable(),
                TextColumn::make('dalit_members')
                    ->searchable(),
                TextColumn::make('other_members')
                    ->searchable(),
                TextColumn::make('uc_meeting_status')
                    ->searchable(),
                TextColumn::make('uc_latest_meeting_date')
                    ->searchable(),
                TextColumn::make('vmw_name')
                    ->searchable(),
                TextColumn::make('trained_vmw')
                    ->searchable(),
                TextColumn::make('vmw_status')
                    ->searchable(),
                TextColumn::make('vmw_salary')
                    ->searchable(),
                TextColumn::make('maintenance_fund_per_house')
                    ->searchable(),
                TextColumn::make('expected_monthly_collection')
                    ->searchable(),
                TextColumn::make('total_fund_deposited')
                    ->searchable(),
                TextColumn::make('fund_location')
                    ->searchable(),
                TextColumn::make('total_expenditure')
                    ->searchable(),
                TextColumn::make('record_status')
                    ->searchable(),
                TextColumn::make('total_households')
                    ->searchable(),
                TextColumn::make('total_taps')
                    ->searchable(),
                TextColumn::make('functional_taps')
                    ->searchable(),
                TextColumn::make('non_functional_taps')
                    ->searchable(),
                TextColumn::make('reason_non_functional')
                    ->searchable(),
                TextColumn::make('scheme_registration_status')
                    ->searchable(),
                TextColumn::make('notice_board_status')
                    ->searchable(),
                TextColumn::make('rvt_status')
                    ->searchable(),
                TextColumn::make('resource_conservation_practice')
                    ->searchable(),
                TextColumn::make('households_with_filter')
                    ->searchable(),
                TextColumn::make('households_with_garbage_dump')
                    ->searchable(),
                TextColumn::make('households_with_drying_rack')
                    ->searchable(),
                TextColumn::make('rvt_photo')
                    ->searchable(),
                TextColumn::make('monitoring_photo')
                    ->searchable(),
                TextColumn::make('solar_lift_photo')
                    ->searchable(),
                TextColumn::make('tap_photo')
                    ->searchable(),
                TextColumn::make('garbage_dryer_photo')
                    ->searchable(),
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
