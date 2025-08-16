<?php

namespace App\Filament\Resources\HouseholdSanitations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class HouseholdSanitationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_id')
                    ->required()
                    ->numeric(),
                TextInput::make('district'),
                TextInput::make('palika'),
                TextInput::make('donor'),
                TextInput::make('scheme_start_year'),
                TextInput::make('scheme_name'),
                TextInput::make('hh_beneficiaries')
                    ->numeric(),
                TextInput::make('hh_having_toilets')
                    ->numeric(),
                TextInput::make('hh_having_chang')
                    ->numeric(),
                TextInput::make('hh_having_handwash_station')
                    ->numeric(),
                TextInput::make('hh_having_filter')
                    ->numeric(),
                TextInput::make('hh_having_waste_disposal_system')
                    ->numeric(),
            ]);
    }
}
