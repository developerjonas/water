<?php

namespace App\Filament\Resources\WaterQualityTests\Schemas;

use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;

class WaterQualityTestForm
{
    public static function schema(): array
    {
        return [
            Wizard::make([
                Step::make('Basic Info')
                    ->description('Enter basic scheme and test point details.')
                    ->schema([
                        Section::make('Scheme Information')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('scheme_code')
                                        ->label('Scheme Code')
                                        ->required(),
                                    TextInput::make('water_quality_tested_point_name')
                                        ->label('Water Quality Tested Point Name')
                                        ->required(),
                                ]),
                            ]),
                    ]),

                Step::make('Water Quality Details')
                    ->description('Enter water quality test results.')
                    ->schema([
                        Section::make('Quality Parameters')
                            ->schema([
                                Grid::make(3)->schema([
                                    TextInput::make('e_coli')
                                        ->label('E. Coli')
                                        ->numeric(),
                                    TextInput::make('coliform')
                                        ->label('Coliform')
                                        ->numeric(),
                                    TextInput::make('ph')
                                        ->label('pH')
                                        ->numeric(),
                                    TextInput::make('frc')
                                        ->label('FRC')
                                        ->numeric(),
                                    TextInput::make('turbidity')
                                        ->label('Turbidity')
                                        ->numeric(),
                                    TextInput::make('e_coli_risk_category')
                                        ->label('E. Coli Risk Category'),
                                    TextInput::make('e_coli_risk_zone')
                                        ->label('E. Coli Risk Zone'),
                                    TextInput::make('coliform_risk_category')
                                        ->label('Coliform Risk Category'),
                                    TextInput::make('coliform_risk_zone')
                                        ->label('Coliform Risk Zone'),
                                ]),
                            ]),
                    ]),
            ])->columnSpanFull(),
        ];
    }
}
