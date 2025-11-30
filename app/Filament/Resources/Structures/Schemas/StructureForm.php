<?php

namespace App\Filament\Resources\Structures\Schemas;

use App\Filament\Components\SchemeSelector;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StructureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                // --- Scheme Context ---
                Section::make('Scheme Association')
                    ->icon('heroicon-m-link')
                    ->compact()
                    ->columns(3)
                    ->schema(
                        SchemeSelector::make() 
                    )
                    ->columnSpanFull(),

                // --- 1. Source & Transmission (6 Cols = 3 Pairs side-by-side) ---
                Section::make('Source & Transmission')
                    ->icon('heroicon-m-arrow-down-on-square-stack')
                    ->columns(2) // Responsive high density
                    ->schema([
                        // Pair 1: Intakes
                        TextInput::make('intakes_planned')->label('Intakes (Plan)')->numeric()->default(0),
                        TextInput::make('intakes_constructed')->label('Intakes (Const)')->numeric()->default(0),

                        // Pair 2: RVTs
                        TextInput::make('rvts_planned')->label('RVTs (Plan)')->numeric()->default(0),
                        TextInput::make('rvts_constructed')->label('RVTs (Const)')->numeric()->default(0),

                        // Pair 3: Transmission
                        TextInput::make('transmission_line_planned')->label('Trans. Line (Plan)')->numeric()->default(0),
                        TextInput::make('transmission_line_constructed')->label('Trans. Line (Const)')->numeric()->default(0),
                    ]),

                // --- 2. Storage & Distribution (6 Cols = 3 Pairs side-by-side) ---
                Section::make('Storage & Distribution')
                    ->icon('heroicon-m-circle-stack')
                    ->columns(2)
                    ->schema([
                        // Pair 1: CC/DC/BPT
                        TextInput::make('cc_dc_bpt_planned')->label('CC/DC/BPT (Plan)')->numeric()->default(0),
                        TextInput::make('cc_dc_bpt_constructed')->label('CC/DC/BPT (Const)')->numeric()->default(0),

                        // Pair 2: Distribution Line
                        TextInput::make('distribution_line_planned')->label('Dist. Line (Plan)')->numeric()->default(0),
                        TextInput::make('distribution_line_constructed')->label('Dist. Line (Const)')->numeric()->default(0),

                        // Pair 3: Other Structures
                        TextInput::make('other_structures_planned')->label('Other (Plan)')->numeric()->default(0),
                        TextInput::make('other_structures_constructed')->label('Other (Const)')->numeric()->default(0),
                    ]),

                // --- 3. Taps & Private Lines (8 Cols = 4 Pairs side-by-side) ---
                Section::make('Tap Connections & Private Lines')
                    ->icon('heroicon-m-home-modern')
                    ->columns(2) // Very high density
                    ->schema([
                        // Pair 1: Public Taps
                        TextInput::make('public_taps_planned')->label('Public (Plan)')->numeric()->default(0),
                        TextInput::make('public_taps_constructed')->label('Public (Const)')->numeric()->default(0),

                        // Pair 2: School Taps
                        TextInput::make('school_taps_planned')->label('School (Plan)')->numeric()->default(0),
                        TextInput::make('school_taps_constructed')->label('School (Const)')->numeric()->default(0),

                        // Pair 3: Private Taps
                        TextInput::make('private_taps_planned')->label('Pvt Taps (Plan)')->numeric()->default(0),
                        TextInput::make('private_taps_constructed')->label('Pvt Taps (Const)')->numeric()->default(0),

                        // Pair 4: Private Lines
                        TextInput::make('private_line_planned')->label('Pvt Line (Plan)')->numeric()->default(0),
                        TextInput::make('private_line_constructed')->label('Pvt Line (Const)')->numeric()->default(0),
                    ]),

                // --- 4. Notes ---
                Section::make('Additional Information')
                    ->icon('heroicon-m-document-text')
                    ->schema([
                        Textarea::make('remarks')
                            ->label('Remarks / Observations')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}