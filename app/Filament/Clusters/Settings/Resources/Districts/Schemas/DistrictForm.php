<?php

namespace App\Filament\Clusters\Settings\Resources\Districts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DistrictForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('province_code')
                    ->required()->readOnly(),
                TextInput::make('district_code')
                    ->required()->readOnly(),
                TextInput::make('name')
                    ->required()->readOnly(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
