<?php

namespace App\Filament\Clusters\Settings\Resources\Partners\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('address'),
                TextInput::make('contact_number'),
                TextInput::make('contact_person'),
            ]);
    }
}
