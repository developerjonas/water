<?php

namespace App\Filament\Resources\Schemes\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StructureRelationManager extends RelationManager
{
    protected static string $relationship = 'Structure';

    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_code')
                    ->required(),
                TextInput::make('intakes_planned')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('intakes_constructed')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('intakes_remaining')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('rvts_planned')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('rvts_constructed')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('rvts_remaining')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('cc_dc_bpt_planned')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('cc_dc_bpt_constructed')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('cc_dc_bpt_remaining')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('other_structures_planned')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('other_structures_constructed')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('other_structures_remaining')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('public_taps_planned')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('public_taps_constructed')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('public_taps_remaining')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('school_taps_planned')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('school_taps_constructed')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('school_taps_remaining')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('private_taps_planned')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('private_taps_constructed')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('private_taps_remaining')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('transmission_line_planned')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('transmission_line_constructed')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('transmission_line_remaining')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('distribution_line_planned')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('distribution_line_constructed')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('distribution_line_remaining')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('private_line_planned')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('private_line_constructed')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('private_line_remaining')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('remarks')
                    ->columnSpanFull(),
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_code'),
                TextEntry::make('intakes_planned')
                    ->numeric(),
                TextEntry::make('intakes_constructed')
                    ->numeric(),
                TextEntry::make('intakes_remaining')
                    ->numeric(),
                TextEntry::make('rvts_planned')
                    ->numeric(),
                TextEntry::make('rvts_constructed')
                    ->numeric(),
                TextEntry::make('rvts_remaining')
                    ->numeric(),
                TextEntry::make('cc_dc_bpt_planned')
                    ->numeric(),
                TextEntry::make('cc_dc_bpt_constructed')
                    ->numeric(),
                TextEntry::make('cc_dc_bpt_remaining')
                    ->numeric(),
                TextEntry::make('other_structures_planned')
                    ->numeric(),
                TextEntry::make('other_structures_constructed')
                    ->numeric(),
                TextEntry::make('other_structures_remaining')
                    ->numeric(),
                TextEntry::make('public_taps_planned')
                    ->numeric(),
                TextEntry::make('public_taps_constructed')
                    ->numeric(),
                TextEntry::make('public_taps_remaining')
                    ->numeric(),
                TextEntry::make('school_taps_planned')
                    ->numeric(),
                TextEntry::make('school_taps_constructed')
                    ->numeric(),
                TextEntry::make('school_taps_remaining')
                    ->numeric(),
                TextEntry::make('private_taps_planned')
                    ->numeric(),
                TextEntry::make('private_taps_constructed')
                    ->numeric(),
                TextEntry::make('private_taps_remaining')
                    ->numeric(),
                TextEntry::make('transmission_line_planned')
                    ->numeric(),
                TextEntry::make('transmission_line_constructed')
                    ->numeric(),
                TextEntry::make('transmission_line_remaining')
                    ->numeric(),
                TextEntry::make('distribution_line_planned')
                    ->numeric(),
                TextEntry::make('distribution_line_constructed')
                    ->numeric(),
                TextEntry::make('distribution_line_remaining')
                    ->numeric(),
                TextEntry::make('private_line_planned')
                    ->numeric(),
                TextEntry::make('private_line_constructed')
                    ->numeric(),
                TextEntry::make('private_line_remaining')
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
            ->recordTitleAttribute('Struct')
            ->columns([
                TextColumn::make('scheme_code')
                    ->searchable(),
                TextColumn::make('intakes_planned')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('intakes_constructed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('intakes_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rvts_planned')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rvts_constructed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('rvts_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cc_dc_bpt_planned')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cc_dc_bpt_constructed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cc_dc_bpt_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('other_structures_planned')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('other_structures_constructed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('other_structures_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('public_taps_planned')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('public_taps_constructed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('public_taps_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('school_taps_planned')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('school_taps_constructed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('school_taps_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('private_taps_planned')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('private_taps_constructed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('private_taps_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('transmission_line_planned')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('transmission_line_constructed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('transmission_line_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('distribution_line_planned')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('distribution_line_constructed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('distribution_line_remaining')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('private_line_planned')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('private_line_constructed')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('private_line_remaining')
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
                AssociateAction::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
