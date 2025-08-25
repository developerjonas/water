<?php

namespace App\Filament\Resources\WaterQualityTests\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use App\Models\Scheme;
use App\Models\WaterPoint;

class WaterQualityTestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Wizard::make([
                Step::make('Scheme Info')
                    ->schema([
                        // 1️⃣ Scheme select
                        Select::make('scheme_code')
                            ->label('Scheme')
                            ->options(Scheme::pluck('scheme_name', 'scheme_code'))
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(fn (callable $set) => $set('water_point_id', null)),

                        // 2️⃣ Water Point select
                        Select::make('water_point_id')
                            ->label('Tested Point')
                            ->options(function ($get) {
                                $schemeCode = $get('scheme_code');
                                if (!$schemeCode) {
                                    return [];
                                }

                                return WaterPoint::where('scheme_code', $schemeCode)
                                    ->whereNotNull('water_system_name')
                                    ->pluck('water_system_name', 'id')
                                    ->toArray();
                            })
                            ->required()
                            ->reactive()
                            ->placeholder('Select a water point'),
                    ]),

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
