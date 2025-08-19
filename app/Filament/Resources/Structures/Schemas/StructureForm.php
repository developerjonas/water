<?php

namespace App\Filament\Resources\Structures\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StructureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_id')
                    ->required()
                    ->numeric(),
                Select::make('type')
                    ->options([
            'Intake' => 'Intake',
            'Intake Filter' => 'Intake filter',
            'DC/IC/CC' => 'D c/ i c/ c c',
            'RVT' => 'R v t',
            'BPT' => 'B p t',
            'FRC' => 'F r c',
            'Private Tap' => 'Private tap',
            'Institutional Tap' => 'Institutional tap',
            'Transmission Line' => 'Transmission line',
            'Distribution Line' => 'Distribution line',
            'Private Line' => 'Private line',
        ])
                    ->required(),
                TextInput::make('estimated')
                    ->numeric(),
                TextInput::make('achieved')
                    ->numeric(),
            ]);
    }
}
