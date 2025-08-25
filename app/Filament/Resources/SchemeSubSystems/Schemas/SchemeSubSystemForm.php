<?php

namespace App\Filament\Resources\SchemeSubSystems\Schemas;

use App\Models\Scheme;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SchemeSubSystemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('scheme_code')
                    ->label('Scheme')
                    ->required()
                    ->searchable()
                    ->options(fn() => Scheme::orderBy('scheme_name')->pluck('scheme_name', 'scheme_code')->toArray()),

                TextInput::make('name')
                    ->label('Sub-system Name')
                    ->required(),

                TextInput::make('type')
                    ->label('Type'),

                TextInput::make('sequence')
                    ->label('Sequence')
                    ->numeric(),

                Toggle::make('is_active')
                    ->label('Is Active')
                    ->required(),
            ]);
    }
}
