<?php

namespace App\Filament\Resources\WaterQualities\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WaterQualityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_id')
                    ->required()
                    ->numeric(),
                TextInput::make('district')
                    ->required(),
                TextInput::make('r_m_palika'),
                TextInput::make('tested_point'),
                TextInput::make('e_coli')
                    ->numeric(),
                TextInput::make('coliform')
                    ->numeric(),
                TextInput::make('ph')
                    ->numeric(),
                TextInput::make('frc')
                    ->numeric(),
                TextInput::make('turbidity')
                    ->numeric(),
                TextInput::make('e_coli_risk_category'),
                TextInput::make('e_coli_percentage')
                    ->numeric(),
                TextInput::make('e_coli_risk_zone'),
                TextInput::make('coliform_risk_category'),
                TextInput::make('coliform_percentage')
                    ->numeric(),
                TextInput::make('coliform_risk_zone'),
            ]);
    }
}
