<?php

namespace App\Filament\Resources\WaterQualityTests\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use App\Filament\Components\SchemeSelector;

class WaterQualityTestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Wizard::make([
                
                Step::make('Scheme')->columns(3)
                    ->schema(SchemeSelector::make()),

                Step::make('Measurements')->columns(1)
                    ->schema([
                        Section::make('Microbiological Parameters')->columns(2)
                            ->schema([
                                TextInput::make('ecoli')
                                    ->label('E.coli (CFU/100ml)')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                                TextInput::make('coliform')
                                    ->label('Coliform (CFU/100ml)')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                            ]),

                        Section::make('Chemical & Physical Parameters')->columns(2)
                            ->schema([
                                TextInput::make('ph')
                                    ->label('pH')
                                    ->numeric()
                                    ->default(7.0)
                                    ->required(),
                                TextInput::make('frc')
                                    ->label('FRC (mg/L)')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                                TextInput::make('turbidity')
                                    ->label('Turbidity (NTU)')
                                    ->numeric()
                                    ->default(0)
                                    ->required(),
                            ]),
                    ]),

                Step::make('Remarks')->columns(1)
                    ->schema([
                        Textarea::make('remarks')
                            ->label('Remarks / Observations')
                            ->columnSpanFull()
                            ->placeholder('Optional notes about the water quality or testing conditions'),
                    ]),
            ])->columnSpanFull(),
        ]);
    }
}
