<?php

namespace App\Filament\Clusters\Settings\Resources\Provinces\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProvinceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('province_code')
                    ->required()->readOnly(),
                TextInput::make('name')
                    ->required()->readOnly(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
