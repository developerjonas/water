<?php

namespace App\Filament\Resources\Beneficiaries\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MemberRelationManager extends RelationManager
{
    protected static string $relationship = 'member';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_code')
                    ->required(),
                TextInput::make('dalit_hh_poor')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('dalit_hh_nonpoor')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('aj_hh_poor')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('aj_hh_nonpoor')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('other_hh_poor')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('other_hh_nonpoor')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('dalit_male')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('aj_male')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('others_male')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('dalit_female')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('aj_female')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('others_female')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('base_population')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('total_schools')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('boys_student')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('girls_student')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('teachers_staff')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_code'),
                TextEntry::make('dalit_hh_poor')
                    ->numeric(),
                TextEntry::make('dalit_hh_nonpoor')
                    ->numeric(),
                TextEntry::make('aj_hh_poor')
                    ->numeric(),
                TextEntry::make('aj_hh_nonpoor')
                    ->numeric(),
                TextEntry::make('other_hh_poor')
                    ->numeric(),
                TextEntry::make('other_hh_nonpoor')
                    ->numeric(),
                TextEntry::make('dalit_male')
                    ->numeric(),
                TextEntry::make('aj_male')
                    ->numeric(),
                TextEntry::make('others_male')
                    ->numeric(),
                TextEntry::make('dalit_female')
                    ->numeric(),
                TextEntry::make('aj_female')
                    ->numeric(),
                TextEntry::make('others_female')
                    ->numeric(),
                TextEntry::make('base_population')
                    ->numeric(),
                TextEntry::make('total_schools')
                    ->numeric(),
                TextEntry::make('boys_student')
                    ->numeric(),
                TextEntry::make('girls_student')
                    ->numeric(),
                TextEntry::make('teachers_staff')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('beneficiary-relation-scheme')
            ->columns([
                TextColumn::make('scheme_code')
                    ->searchable(),
                TextColumn::make('dalit_hh_poor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dalit_hh_nonpoor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('aj_hh_poor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('aj_hh_nonpoor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('other_hh_poor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('other_hh_nonpoor')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dalit_male')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('aj_male')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('others_male')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('dalit_female')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('aj_female')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('others_female')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('base_population')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_schools')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('boys_student')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('girls_student')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('teachers_staff')
                    ->numeric()
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
            ->headerActions([
                CreateAction::make(),
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
