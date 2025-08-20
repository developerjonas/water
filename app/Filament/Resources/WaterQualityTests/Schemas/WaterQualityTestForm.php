<?php

namespace App\Filament\Resources\WaterQualityTests\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use App\Models\Scheme;

class WaterQualityTestForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Wizard::make([
                Step::make('Scheme Info')
                    ->schema([
                        Select::make('scheme_code')
                            ->label('Scheme')
                            ->options(Scheme::all()->pluck('scheme_name', 'scheme_code'))
                            ->searchable()
                            ->required(),
                        TextInput::make('tested_point')
                            ->label('Tested Point')
                            ->required(),
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
