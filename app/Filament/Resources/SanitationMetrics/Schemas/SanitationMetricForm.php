<?php

namespace App\Filament\Resources\SanitationMetrics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use App\Filament\Components\SchemeSelector;

class SanitationMetricForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make()
                    ->steps([

                        Step::make('Scheme')->columns(3)
                            ->schema(SchemeSelector::make()),

                        Step::make('Household Counts')->columns(1)
                            ->schema([
                                Section::make('Household Facilities')->columns(3)
                                    ->schema([
                                        TextInput::make('households_total')
                                            ->label('Total Households')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),

                                        TextInput::make('households_with_toilet')
                                            ->label('Households with Toilet')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),

                                        TextInput::make('households_with_drying_rack')
                                            ->label('Households with Drying Rack')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),

                                        TextInput::make('households_with_handwashing_station')
                                            ->label('Households with Handwashing Station')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),

                                        TextInput::make('households_using_filter')
                                            ->label('Households Using Filter')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),

                                        TextInput::make('households_with_waste_disposal_pit')
                                            ->label('Households with Waste Disposal Pit')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),
                                    ]),
                            ]),

                        Step::make('Sanitation Status')->columns(1)
                            ->schema([
                                Section::make('Declaration Status')->columns(1)
                                    ->schema([
                                        Select::make('total_sanitation_status')
                                            ->label('Total Sanitation Declaration Status')
                                            ->options([
                                                'yes' => 'Yes',
                                                'no' => 'No',
                                                'partial' => 'Partial',
                                            ])
                                            ->required(),

                                        TextInput::make('remarks')
                                            ->label('Remarks')
                                            ->placeholder('Optional notes'),
                                    ]),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
