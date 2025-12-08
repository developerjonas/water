<?php

namespace App\Filament\Resources\WaterPoints\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use App\Filament\Components\SchemeSelector;

class WaterPointForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        
                        // --- SECTION 1: LINKING (Scheme) ---
                        Section::make('Scheme Association')->columns(3)
                            ->description('Link this point to a Master Scheme.')
                            ->schema([
                                ...SchemeSelector::make()
                            ]),

                        // --- SECTION 2: IDENTIFICATION ---
                        Section::make('General Information')
                            ->schema([
                                Grid::make(3)->schema([
                                    TextInput::make('water_point_name')
                                        ->label('Water Point / Owner Name')
                                        ->placeholder('e.g. Janak Bista (Ka)')
                                        ->required()
                                        ->columnSpan(2),

                                    Select::make('location_type')
                                        ->label('Location Type')
                                        ->options([
                                            'Community' => 'Community',
                                            'School' => 'School',
                                            'Health Post' => 'Health Post',
                                            'Public' => 'Public Tap',
                                            'Private' => 'Private',
                                        ])
                                        ->default('Community')
                                        ->required(),

                                    TextInput::make('tole')
                                        ->label('Tole / Cluster')
                                        ->placeholder('e.g. Puntegada Tole'),

                                    TextInput::make('ward_no')
                                        ->label('Ward No') // CSV has "1,2,8&9" - keep as text
                                        ->placeholder('e.g. 1'),
                                        
                                    Select::make('tap_construction_status')
                                        ->label('Construction Complete?')
                                        ->options([
                                            'Yes' => 'Yes',
                                            'No' => 'No',
                                        ])
                                        ->native(false)
                                        ->required(),
                                ]),
                            ]),

                        // --- SECTION 3: SOCIAL & ECONOMIC DATA ---
                        Section::make('Socio-Economic Profile')
                            ->description('Household details, ethnicity, and economic status.')
                            ->schema([
                                Grid::make(3)->schema([
                                    
                                    TextInput::make('households_count')
                                        ->label('HH Count')
                                        ->numeric()
                                        ->default(1),

                                    Select::make('ethnicity')
                                        ->label('Ethnicity')
                                        ->options([
                                            'Dalit' => 'Dalit',
                                            'Janjati' => 'Janjati',
                                            'Other' => 'Other', // Matches your CSV "Other"
                                            'Muslim' => 'Muslim',
                                        ]),

                                    Select::make('economic_status')
                                        ->label('Economic Status')
                                        ->options([
                                            'Poor' => 'Poor',
                                            'Non-Poor' => 'Non-Poor', // Matches "Poor/None-Poor"
                                            'Ultra-Poor' => 'Ultra-Poor',
                                        ]),
                                ]),
                            ]),

                        // --- SECTION 4: DEMOGRAPHICS ---
                        Section::make('User Demographics')
                            ->schema([
                                Grid::make(3)->schema([
                                    TextInput::make('woman')
                                        ->label('Women')
                                        ->numeric()
                                        ->default(0)
                                        ->live()
                                        ->afterStateUpdated(fn ($set, $get) => $set('total_users', (int)$get('woman') + (int)$get('man'))),

                                    TextInput::make('man')
                                        ->label('Men')
                                        ->numeric()
                                        ->default(0)
                                        ->live()
                                        ->afterStateUpdated(fn ($set, $get) => $set('total_users', (int)$get('woman') + (int)$get('man'))),

                                    TextInput::make('total_users') // Calculated field
                                        ->label('Total Users')
                                        ->numeric()
                                        ->readOnly(),
                                ]),
                            ]),

                        // --- SECTION 5: NOTES ---
                        Section::make('Additional Info')
                            ->collapsed()
                            ->schema([
                                Textarea::make('remarks')
                                    ->rows(2)
                                    ->columnSpanFull(),
                            ]),

                    ])->columnSpanFull(),
            ]);
    }
}