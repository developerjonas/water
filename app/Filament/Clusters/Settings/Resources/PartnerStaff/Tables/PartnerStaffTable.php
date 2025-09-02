<?php

namespace App\Filament\Clusters\Settings\Resources\PartnerStaff\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Partner;

class PartnerStaffTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('partner_code')
                    ->label('Partner')
                    ->formatStateUsing(fn ($state) => 
                        Partner::where('partner_code', $state)->value('name') ?? $state
                    )
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Staff Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email Address')
                    ->searchable()
                    ->copyable()
                    ->url(fn ($record) => 'mailto:' . $record->email, true),

                TextColumn::make('phone')
                    ->label('Phone Number')
                    ->searchable()
                    ->copyable()
                    ->url(fn ($record) => 'tel:' . $record->phone, true)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('position')
                    ->label('Position')
                    ->searchable()
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
                // Add filters like Partner or Position if needed
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
