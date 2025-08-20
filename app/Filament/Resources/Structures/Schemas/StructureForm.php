<?php

namespace App\Filament\Resources\Structures\Schemas;

use App\Models\Scheme;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;

class StructureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    // Step 1: Scheme Reference
                    Wizard\Step::make('Scheme Reference')
                        ->schema([
                            Select::make('scheme_code')
                                ->label('Scheme Code')
                                ->options(Scheme::all()->pluck('scheme_name', 'scheme_code')->toArray())
                                ->searchable()
                                ->required(),
                        ]),

                    // Step 2: Intakes & RVTs
                    Wizard\Step::make('Intakes & RVTs')
                        ->schema([
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
                        ]),

                    // Step 3: CC/DC/BPT/IC/Valvebox & Other Structures
                    Wizard\Step::make('Structures')
                        ->schema([
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
                            TextInput::make('other_structures_constructed')
                                ->label('Other Structures (FRC/Custom) Constructed')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('other_structures_remaining')
                                ->label('Other Structures (FRC/Custom) Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),
                        ]),

                    // Step 4: Taps
                    Wizard\Step::make('Taps')
                        ->schema([
                            TextInput::make('public_taps')
                                ->label('Public Taps')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('school_taps')
                                ->label('School Taps')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('private_taps')
                                ->label('Private Taps')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('taps_constructed_progress')
                                ->label('Taps Constructed Progress')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('taps_remaining')
                                ->label('Taps Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),
                        ]),

                    // Step 5: Lines
                    Wizard\Step::make('Lines')
                        ->schema([
                            TextInput::make('transmission_line_progress')
                                ->label('Transmission Line Progress')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('transmission_line_remaining')
                                ->label('Transmission Line Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('distribution_line_progress')
                                ->label('Distribution Line Progress')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('distribution_line_remaining')
                                ->label('Distribution Line Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('private_line_progress')
                                ->label('Private Line Progress')
                                ->numeric()
                                ->default(0)
                                ->required(),
                            TextInput::make('private_line_remaining')
                                ->label('Private Line Remaining')
                                ->numeric()
                                ->default(0)
                                ->required(),
                        ]),

                    // Step 6: Status & Remarks
                    Wizard\Step::make('Status & Remarks')
                        ->schema([
                            Toggle::make('mb_submitted_to_municipality')
                                ->label('MB Submitted to Municipality')
                                ->required(),
                            Toggle::make('municipality_contribution_transferred')
                                ->label('Municipality Contribution Transferred')
                                ->required(),
                            Toggle::make('public_hearing_done')
                                ->label('Public Hearing Done')
                                ->required(),
                            Toggle::make('public_review_done')
                                ->label('Public Review Done')
                                ->required(),
                            Toggle::make('final_public_audit_done')
                                ->label('Final Public Audit Done')
                                ->required(),
                            Textarea::make('remarks')
                                ->label('Remarks for Municipality Contributions')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
