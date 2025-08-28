<?php

namespace App\Filament\Resources\WaterQualityTests\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use App\Filament\Components\SchemeSelector;

class WaterQualityTestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Wizard::make([
                // Step 1: Scheme & Formation
                Step::make('Scheme & Formation')
                    ->schema(SchemeSelector::make()),

                Step::make('Measurements')
                    ->schema([
                        TextInput::make('ecoli')
                            ->label('E.coli (CFU/100ml)')
                            ->numeric()
                            ->default(0),
                        TextInput::make('coliform')
                            ->label('Coliform (CFU/100ml)')
                            ->numeric()
                            ->default(0),
                        TextInput::make('ph')
                            ->label('pH')
                            ->numeric()
                            ->default(7.0),
                        TextInput::make('frc')
                            ->label('FRC (mg/L)')
                            ->numeric()
                            ->default(0),
                        TextInput::make('turbidity')
                            ->label('Turbidity (NTU)')
                            ->numeric()
                            ->default(0),
                    ]),

                Step::make('Remarks')
                    ->schema([
                        Textarea::make('remarks')
                            ->label('Remarks')
                            ->columnSpanFull(),
                    ]),
            ]),
        ]);
    }
}
