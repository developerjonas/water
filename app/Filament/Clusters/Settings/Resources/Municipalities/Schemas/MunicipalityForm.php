<?php

namespace App\Filament\Clusters\Settings\Resources\Municipalities\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MunicipalityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('district_code')
                    ->required()->readOnly(),
                TextInput::make('municipality_code')->readOnly(),
                TextInput::make('name')
                    ->required()->readOnly(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
