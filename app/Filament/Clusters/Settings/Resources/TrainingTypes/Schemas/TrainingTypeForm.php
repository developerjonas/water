<?php

namespace App\Filament\Clusters\Settings\Resources\TrainingTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TrainingTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('level'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
