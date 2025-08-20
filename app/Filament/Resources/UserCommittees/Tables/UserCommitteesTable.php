<?php

namespace App\Filament\Resources\UserCommittees\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserCommitteesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('scheme_code')
                    ->searchable(),
                TextColumn::make('date_of_formation')
                    ->date()
                    ->sortable(),
                TextColumn::make('user_committee_bank_account_name')
                    ->searchable(),
                TextColumn::make('chair_name')
                    ->searchable(),
                TextColumn::make('chair_contact')
                    ->searchable(),
                TextColumn::make('vice_chair_name')
                    ->searchable(),
                TextColumn::make('vice_chair_contact')
                    ->searchable(),
                TextColumn::make('secretary_name')
                    ->searchable(),
                TextColumn::make('secretary_contact')
                    ->searchable(),
                TextColumn::make('deputy_secretary_name')
                    ->searchable(),
                TextColumn::make('deputy_secretary_contact')
                    ->searchable(),
                TextColumn::make('treasurer_name')
                    ->searchable(),
                TextColumn::make('treasurer_contact')
                    ->searchable(),
                TextColumn::make('dalit_female_key')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dalit_male_key')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dalit_female_member')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dalit_male_member')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('janjati_female_key')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('janjati_male_key')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('janjati_female_member')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('janjati_male_member')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('others_female_key')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('others_male_key')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('others_female_member')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('others_male_member')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('wusc_registration_status')
                    ->searchable(),
                TextColumn::make('registration_number')
                    ->searchable(),
                TextColumn::make('contract_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('contract_expiry_date')
                    ->date()
                    ->sortable(),
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
