<?php

namespace App\Filament\Resources\SanitationMetrics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use App\Filament\Components\SchemeSelector;

class SanitationMetricForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make()
                    ->steps([
                        // Step 1: Scheme & Formation
                    
                    // Step 1: Scheme & Formation
                    Step::make('Scheme & Formation')
                    ->schema(SchemeSelector::make()),

                        Wizard\Step::make('Household Counts')
                            ->schema([
                                TextInput::make('households_total')
                                    ->label('Total Households')
                                    ->default(0)
                                    ->required(),

                                TextInput::make('households_with_toilet')
                                    ->label('Households with Toilet')
                                    ->default(0)
                                    ->required(),

                                TextInput::make('households_with_drying_rack')
                                    ->label('Households with Drying Rack')
                                    ->default(0)
                                    ->required(),

                                TextInput::make('households_with_handwashing_station')
                                    ->label('Households with Handwashing Station')
                                    ->default(0)
                                    ->required(),

                                TextInput::make('households_using_filter')
                                    ->label('Households Using Filter')
                                    ->default(0)
                                    ->required(),

                                TextInput::make('households_with_waste_disposal_pit')
                                    ->label('Households with Waste Disposal Pit')
                                    ->default(0)
                                    ->required(),
                            ]),

                        Wizard\Step::make('Sanitation Status')
                            ->schema([
                                TextInput::make('total_sanitation_status')
                                    ->label('Total Sanitation Declaration Status')
                                    ->placeholder('Yes / No / Partial'),

                                TextInput::make('remarks')
                                    ->label('Remarks')
                                    ->placeholder('Optional notes'),
                            ]),
                    ]),
            ]);
    }
}
