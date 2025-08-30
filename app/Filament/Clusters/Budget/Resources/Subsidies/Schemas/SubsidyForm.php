<?php

namespace App\Filament\Clusters\Budget\Resources\Subsidies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubsidyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_code')
                    ->required(),
                TextInput::make('total_estimated')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('helvetas_cash')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                TextInput::make('helvetas_kind')
                    ->required()
                    ->numeric()
                    ->default(0.0),
            ]);
    }
}
