<?php

namespace App\Filament\Resources\SanitationMetrics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema; // Keeping your custom Schema class usage
use App\Filament\Components\SchemeSelector;

class SanitationMetricForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        
                        // --- SECTION 1: SCHEME SELECTION ---
                        Section::make('Scheme Details')->columns(3)
                            ->description('Select the scheme this metric belongs to.')->columnSpan(3)
                            ->schema([
                                ...SchemeSelector::make(),
                            ]),

                        // --- SECTION 2: HOUSEHOLD FACILITIES ---
                        Section::make('Household Facilities')
                            ->description('Enter the counts for various sanitation facilities.')
                            ->schema([
                                Grid::make(3)->schema([
                                    
                                    // Row 1: Basic Hygiene
                                    TextInput::make('households_total')
                                        ->label('Total Households')
                                        ->numeric()
                                        ->default(0)
                                        ->required(),

                                    TextInput::make('households_with_toilet')
                                        ->label('With Toilet')
                                        ->numeric()
                                        ->default(0)
                                        ->required(),

                                    TextInput::make('households_with_handwashing_station')
                                        ->label('With Handwashing Stn.')
                                        ->numeric()
                                        ->default(0)
                                        ->required(),

                                    // Row 2: Advanced / Other
                                    TextInput::make('households_with_drying_rack')
                                        ->label('With Drying Rack')
                                        ->numeric()
                                        ->default(0)
                                        ->required(),

                                    TextInput::make('households_using_filter')
                                        ->label('Using Water Filter')
                                        ->numeric()
                                        ->default(0)
                                        ->required(),

                                    TextInput::make('households_with_waste_disposal_pit')
                                        ->label('With Waste Disposal Pit')
                                        ->numeric()
                                        ->default(0)
                                        ->required(),
                                ]),
                            ]),

                        // --- SECTION 3: STATUS & REMARKS ---
                        Section::make('Declaration & Status')
                            ->schema([
                                Grid::make(2)->schema([
                                    Select::make('total_sanitation_status')
                                        ->label('Total Sanitation Declaration Status')
                                        ->options([
                                            'yes' => 'Yes (Declared)',
                                            'no' => 'No (Not Declared)',
                                            'partial' => 'Partial',
                                        ])
                                        ->native(false)
                                        ->required(),

                                    Textarea::make('remarks') // Changed to Textarea for better UX
                                        ->label('Remarks')
                                        ->rows(1)
                                        ->placeholder('Optional notes regarding this survey...'),
                                ]),
                            ]),

                    ])->columnSpanFull(),
            ]);
    }
}