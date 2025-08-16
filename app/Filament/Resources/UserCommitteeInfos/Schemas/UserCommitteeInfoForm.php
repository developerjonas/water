<?php

namespace App\Filament\Resources\UserCommitteeInfos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserCommitteeInfoForm
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
                TextInput::make('name'),
                TextInput::make('position'),
                TextInput::make('ethnicity_gender'),
                TextInput::make('contact_no'),
            ]);
    }
}
