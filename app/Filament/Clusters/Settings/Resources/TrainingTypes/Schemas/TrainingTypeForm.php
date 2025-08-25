<?php

namespace App\Filament\Clusters\Settings\Resources\TrainingTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class TrainingTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('level')
                    ->label('Training Level')
                    ->required()
                    ->options([
                        'Ward' => 'Ward Level',
                        'Municipality' => 'Municipality Level',
                        'Scheme' => 'Scheme Level',
                    ])
                    ->placeholder('Select Level'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
