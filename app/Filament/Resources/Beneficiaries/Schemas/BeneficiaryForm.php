<?php

namespace App\Filament\Resources\Beneficiaries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BeneficiaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('district'),
                TextInput::make('palika'),
                TextInput::make('scheme_id')
                    ->required()
                    ->numeric(),
                TextInput::make('sector'),
                TextInput::make('sub_schemes')
                    ->numeric(),
                TextInput::make('total_female')
                    ->numeric(),
                TextInput::make('total_male')
                    ->numeric(),
                TextInput::make('total_beneficiaries')
                    ->numeric(),
                TextInput::make('schools')
                    ->numeric(),
                TextInput::make('taps_provided')
                    ->numeric(),
                TextInput::make('boys_students')
                    ->numeric(),
                TextInput::make('girls_students')
                    ->numeric(),
                TextInput::make('teachers')
                    ->numeric(),
                TextInput::make('total_population')
                    ->numeric(),
            ]);
    }
}
