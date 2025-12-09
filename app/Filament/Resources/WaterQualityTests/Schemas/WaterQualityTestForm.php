<?php

namespace App\Filament\Resources\WaterQualityTests\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use App\Filament\Components\SchemeSelector;

class WaterQualityTestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                // --- SECTION 1: SCHEME CONTEXT (Independent) ---
                Section::make('Scheme Context')->columns(3)->columnSpanFull()
                    ->description('Select the project this test belongs to.')
                    ->schema([
                        ...SchemeSelector::make(),
                    ]),

                // --- SECTION 2: SAMPLE DETAILS (The 4-Column Grid) ---
                Section::make('Sample Details')
                    ->description('Specific water point location and test date.')
                    ->schema([
                        Grid::make(3)->schema([
                            
                            // 1/4: Link Asset
                            Select::make('water_point_id')
                                ->label('Link Asset')
                                ->relationship('waterPoint', 'water_point_name')
                                ->searchable()
                                ->preload()
                                ->placeholder('Select asset...')
                                ->columnSpan(3),

                            // 2/4: Manual Name (Wider)
                            TextInput::make('tested_point_name')
                                ->label('Tested Point Name')
                                ->placeholder('e.g. School Tap')
                                ->required()
                                ->columnSpan(2),
                                
                            // 1/4: Date
                            DatePicker::make('test_date')
                                ->label('Test Date')
                                ->default(now())
                                ->maxDate(now())
                                ->required()
                                ->columnSpan(1),
                        ]),
                    ]),

                // --- SECTION 3: MICROBIOLOGICAL ---
                Section::make('Microbiological Parameters')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('ecoli')
                                ->label('E.coli (CFU/100ml)')
                                ->numeric()
                                ->default(0)
                                ->live()
                                ->helperText(fn ($state) => match(true) {
                                    $state === null => '',
                                    $state == 0 => '✅ Safe (Zero Risk)',
                                    $state <= 10 => '⚠️ Low Risk',
                                    $state <= 100 => '☣️ Intermediate Risk',
                                    default => '☠️ High Risk',
                                })
                                ->required(),

                            TextInput::make('coliform')
                                ->label('Total Coliform (CFU/100ml)')
                                ->numeric()
                                ->default(0)
                                ->live()
                                ->helperText(fn ($state) => match(true) {
                                    $state === null => '',
                                    $state == 0 => '✅ Safe (Zero Risk)',
                                    $state <= 10 => '⚠️ Low Risk',
                                    $state <= 100 => '☣️ Intermediate Risk',
                                    default => '☠️ High Risk',
                                })
                                ->required(),
                        ]),
                    ]),

                // --- SECTION 4: PHYSICAL & CHEMICAL ---
                Section::make('Physical & Chemical Parameters')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('ph')
                                ->label('pH Level')
                                ->numeric()
                                ->step(0.1)
                                ->default(7.0)
                                ->suffix('pH')
                                ->helperText('Standard: 6.5 - 8.5'),

                            TextInput::make('turbidity')
                                ->label('Turbidity')
                                ->numeric()
                                ->step(0.1)
                                ->suffix('NTU')
                                ->helperText('Standard: < 5 NTU'),

                            TextInput::make('frc')
                                ->label('Free Residual Chlorine')
                                ->numeric()
                                ->step(0.01)
                                ->suffix('mg/L')
                                ->helperText('Standard: 0.1 - 0.5 mg/L'),
                        ]),
                    ]),

                // --- SECTION 5: REMARKS ---
                Section::make('Notes')
                    ->schema([
                        Textarea::make('remarks')
                            ->label('Observations')
                            ->rows(2)
                            ->columnSpanFull()
                            ->placeholder('e.g. Sample taken after heavy rain'),
                    ]),
            ]);
    }
}