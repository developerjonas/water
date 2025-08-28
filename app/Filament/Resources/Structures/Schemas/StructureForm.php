<?php

namespace App\Filament\Resources\Structures\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use App\Filament\Components\SchemeSelector;

class StructureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([

                    // Step 1: Scheme & Formation
                    Step::make('Scheme & Formation')
                    ->schema(SchemeSelector::make()),

                    // Step 2: Intakes & RVTs (Planned / Constructed / Remaining)
                    Wizard\Step::make('Intakes & RVTs')
                        ->schema([
                            TextInput::make('intakes_planned')
                                ->label('Intakes Planned')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('intakes_constructed')
                                ->label('Intakes Constructed')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('intakes_remaining')
                                ->label('Intakes Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),

                            TextInput::make('rvts_planned')
                                ->label('RVTs Planned')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('rvts_constructed')
                                ->label('RVTs Constructed')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('rvts_remaining')
                                ->label('RVTs Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),
                        ])->columns(3),

                    // Step 3: Structures (Planned / Constructed / Remaining)
                    Wizard\Step::make('Structures')
                        ->schema([
                            TextInput::make('cc_dc_bpt_planned')
                                ->label('CC/DC/BPT/IC/Valvebox Planned')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('cc_dc_bpt_constructed')
                                ->label('CC/DC/BPT/IC/Valvebox Constructed')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('cc_dc_bpt_remaining')
                                ->label('CC/DC/BPT/IC/Valvebox Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),

                            TextInput::make('other_structures_planned')
                                ->label('Other Structures Planned')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('other_structures_constructed')
                                ->label('Other Structures Constructed')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('other_structures_remaining')
                                ->label('Other Structures Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),
                        ])->columns(3),

                    // Step 4: Taps (Planned / Constructed / Remaining)
                    Wizard\Step::make('Taps')
                        ->schema([
                            TextInput::make('public_taps_planned')
                                ->label('Public Taps Planned')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('public_taps_constructed')
                                ->label('Public Taps Constructed')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('public_taps_remaining')
                                ->label('Public Taps Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),

                            TextInput::make('school_taps_planned')
                                ->label('School Taps Planned')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('school_taps_constructed')
                                ->label('School Taps Constructed')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('school_taps_remaining')
                                ->label('School Taps Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),

                            TextInput::make('private_taps_planned')
                                ->label('Private Taps Planned')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('private_taps_constructed')
                                ->label('Private Taps Constructed')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('private_taps_remaining')
                                ->label('Private Taps Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),
                        ])->columns(3),

                    // Step 5: Lines (Planned / Constructed / Remaining)
                    Wizard\Step::make('Lines')
                        ->schema([
                            TextInput::make('transmission_line_planned')
                                ->label('Transmission Line Planned')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('transmission_line_constructed')
                                ->label('Transmission Line Constructed')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('transmission_line_remaining')
                                ->label('Transmission Line Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),

                            TextInput::make('distribution_line_planned')
                                ->label('Distribution Line Planned')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('distribution_line_constructed')
                                ->label('Distribution Line Constructed')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('distribution_line_remaining')
                                ->label('Distribution Line Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),

                            TextInput::make('private_line_planned')
                                ->label('Private Line Planned')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('private_line_constructed')
                                ->label('Private Line Constructed')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('private_line_remaining')
                                ->label('Private Line Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),
                        ])->columns(3),

                    // Step 6: Status & Remarks
                    Wizard\Step::make('Status & Remarks')
                        ->schema([
                            
                            Textarea::make('remarks')
                                ->label('Remarks for Municipality Contributions')
                                ->columnSpanFull(),
                        ]),

                ])->columnSpanFull(),
            ]);
    }
}
