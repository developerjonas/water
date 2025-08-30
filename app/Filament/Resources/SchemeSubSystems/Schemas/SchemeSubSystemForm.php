<?php

namespace App\Filament\Resources\SchemeSubSystems\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SchemeSubSystemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_code')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('type'),
                TextInput::make('sequence')
                    ->numeric(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
