<?php

namespace App\Filament\Resources\Beneficiaries\Schemas;

use App\Filament\Components\SchemeSelector;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BeneficiaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                // --- Top: Scheme Context ---
                Section::make('Scheme Association')
                    ->icon('heroicon-m-link')
                    ->compact()
                    ->columns(3) 
                    ->schema(
                        SchemeSelector::make() 
                    )
                    ->columnSpanFull(),

                // --- 1. Households (HH) Configuration ---
                Section::make('Household Composition')
                    ->description('Breakdown of households by poverty status.')
                    ->icon('heroicon-m-home')
                    ->columns(2) 
                    ->schema([
                        // Pair 1: Dalit
                        TextInput::make('dalit_hh_poor')->label('Dalit (Poor)')->numeric()->default(0),
                        TextInput::make('dalit_hh_nonpoor')->label('Dalit (Non-Poor)')->numeric()->default(0),

                        // Pair 2: Janajati (A/J)
                        TextInput::make('aj_hh_poor')->label('Janajati (Poor)')->numeric()->default(0),
                        TextInput::make('aj_hh_nonpoor')->label('Janajati (Non-Poor)')->numeric()->default(0),

                        // Pair 3: Others
                        TextInput::make('other_hh_poor')->label('Others (Poor)')->numeric()->default(0),
                        TextInput::make('other_hh_nonpoor')->label('Others (Non-Poor)')->numeric()->default(0),
                    ]),

                // --- 2. Individual Population ---
                Section::make('Population Details')
                    ->description('Total individual beneficiaries split by gender.')
                    ->icon('heroicon-m-users')
                    ->columns(2) 
                    ->schema([
                        // Pair 1: Dalit
                        TextInput::make('dalit_male')->label('Dalit (Male)')->numeric()->default(0),
                        TextInput::make('dalit_female')->label('Dalit (Female)')->numeric()->default(0),

                        // Pair 2: Janajati
                        TextInput::make('aj_male')->label('Janajati (Male)')->numeric()->default(0),
                        TextInput::make('aj_female')->label('Janajati (Female)')->numeric()->default(0),

                        // Pair 3: Others
                        TextInput::make('others_male')->label('Others (Male)')->numeric()->default(0),
                        TextInput::make('others_female')->label('Others (Female)')->numeric()->default(0),
                    ]),

                // --- 3. School & General Stats ---
                Section::make('School & Base Data')
                    ->icon('heroicon-m-academic-cap')
                    ->columns(2) 
                    ->schema([
                        TextInput::make('base_population')
                            ->label('Base Population')
                            ->numeric()
                            ->default(0)
                            ->prefixIcon('heroicon-m-user-group'),

                        TextInput::make('total_schools')
                            ->label('Total Schools')
                            ->numeric()
                            ->default(0),

                        TextInput::make('boys_student')
                            ->label('Boy Students')
                            ->numeric()
                            ->default(0),

                        TextInput::make('girls_student')
                            ->label('Girl Students')
                            ->numeric()
                            ->default(0),

                        TextInput::make('teachers_staff')
                            ->label('Teachers / Staff')
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }
}