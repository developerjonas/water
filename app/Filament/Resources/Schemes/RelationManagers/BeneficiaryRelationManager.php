<?php

namespace App\Filament\Resources\Schemes\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Schemas\Schema; // <-- v2 syntax (like your example)
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Components\Section; // <-- v2 syntax (like your example)
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
// use Filament\Actions\BulkActionGroup; // <-- REMOVED (This is v3)


class BeneficiaryRelationManager extends RelationManager
{
    protected static string $relationship = 'beneficiaries';

    public function isReadOnly(): bool
    {
        return false;
    }

    // This is v2 syntax (like your example)
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([ // <-- v2 method (like your example)
                Forms\Components\TextInput::make('scheme_code')
                    ->required()
                    ->maxLength(255)
                    ->hidden(),

                Section::make('Household Beneficiaries')
                    ->components([
                        Forms\Components\TextInput::make('dalit_hh_poor')->numeric()->label('Dalit HH (Poor)'),
                        Forms\Components\TextInput::make('dalit_hh_nonpoor')->numeric()->label('Dalit HH (Non-Poor)'),
                        Forms\Components\TextInput::make('aj_hh_poor')->numeric()->label('AJ HH (Poor)'),
                        Forms\Components\TextInput::make('aj_hh_nonpoor')->numeric()->label('AJ HH (Non-Poor)'),
                        Forms\Components\TextInput::make('other_hh_poor')->numeric()->label('Other HH (Poor)'),
                        Forms\Components\TextInput::make('other_hh_nonpoor')->numeric()->label('Other HH (Non-Poor)'),
                    ])->columns(3),

                Section::make('Individual Beneficiaries')
                    ->components([
                        Forms\Components\TextInput::make('dalit_male')->numeric(),
                        Forms\Components\TextInput::make('aj_male')->numeric(),
                        Forms\Components\TextInput::make('others_male')->numeric(),
                        Forms\Components\TextInput::make('dalit_female')->numeric(),
                        Forms\Components\TextInput::make('aj_female')->numeric(),
                        Forms\Components\TextInput::make('others_female'),
                    ])->columns(3),

                Section::make('School & Population')
                    ->components([
                        Forms\Components\TextInput::make('base_population')->numeric(),
                        Forms\Components\TextInput::make('total_schools')->numeric(),
                        Forms\Components\TextInput::make('boys_student')->numeric(),
                        Forms\Components\TextInput::make('girls_student')->numeric(),
                        Forms\Components\TextInput::make('teachers_staff')->numeric(),
                    ])->columns(3),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('scheme_code')
            ->columns([
                Tables\Columns\TextColumn::make('scheme_code')
                    ->searchable()
                    ->sortable()
                    ->hidden(),

                Tables\Columns\TextColumn::make('household_total')
                    ->label('Total Households')
                    ->getStateUsing(fn ($record) => $record->household_total),

                Tables\Columns\TextColumn::make('individual_total')
                    ->label('Total Individuals')
                    ->getStateUsing(fn ($record) => $record->individual_total),

                Tables\Columns\TextColumn::make('school_total')
                    ->label('Total School Pop.')
                    ->getStateUsing(fn ($record) => $record->school_total),

                Tables\Columns\TextColumn::make('total_beneficiaries')
                    ->label('Grand Total')
                    ->getStateUsing(fn ($record) => $record->total_beneficiaries)
                    ->color('success')
                    ->weight('bold'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(fn (array $data): array => [
                        ...$data,
                        'scheme_code' => $this->ownerRecord->scheme_code,
                    ])
                    // This forces the button to always show
                    ->hidden(false),
            ])
            ->actions([ // <-- This is 'recordActions' in your v2 example, but 'actions' also works
                EditAction::make()
                    ->mutateFormDataUsing(fn (array $data): array => [
                        ...$data,
                        'scheme_code' => $this->ownerRecord->scheme_code,
                    ]),
                DeleteAction::make(),
            ])
            /**
             * ✅ THE FIX
             * Changed 'bulkActions' (v3) to 'toolbarActions' (v2)
             * to match your working example.
             */
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }
}