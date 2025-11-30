<?php

namespace App\Filament\Resources\Structures\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;

class StructureInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                
                // --- Scheme Context ---
                Section::make('Scheme Association')
                    ->icon('heroicon-m-link')
                    ->compact()
                    ->columns(3)
                    ->schema([
                        // Replaces SchemeSelector with read-only data
                        TextEntry::make('scheme.scheme_name')
                            ->label('Scheme Name')
                            ->weight('bold'),
                        TextEntry::make('scheme.scheme_code_user')
                            ->label('Scheme Code')
                            ->color('gray')
                            ->copyable(),
                        TextEntry::make('scheme.province')
                            ->label('Province'),
                    ])
                    ->columnSpanFull(),

                // --- 1. Source & Transmission ---
                Section::make('Source & Transmission')
                    ->icon('heroicon-m-arrow-down-on-square-stack')
                    ->columns(4) // 4 columns allows 2 pairs per row on large screens, or sticks to 2 cols on smaller
                    ->schema([
                        // Pair 1: Intakes
                        TextEntry::make('intakes_planned')->label('Intakes (Plan)')->badge()->color('gray'),
                        TextEntry::make('intakes_constructed')->label('Intakes (Const)')->badge()->color('success'),

                        // Pair 2: RVTs
                        TextEntry::make('rvts_planned')->label('RVTs (Plan)')->badge()->color('gray'),
                        TextEntry::make('rvts_constructed')->label('RVTs (Const)')->badge()->color('success'),

                        // Pair 3: Transmission
                        TextEntry::make('transmission_line_planned')->label('Trans. Line (Plan)')->badge()->color('gray'),
                        TextEntry::make('transmission_line_constructed')->label('Trans. Line (Const)')->badge()->color('success'),
                    ]),

                // --- 2. Storage & Distribution ---
                Section::make('Storage & Distribution')
                    ->icon('heroicon-m-circle-stack')
                    ->columns(4)
                    ->schema([
                        // Pair 1: CC/DC/BPT
                        TextEntry::make('cc_dc_bpt_planned')->label('CC/DC/BPT (Plan)')->badge()->color('gray'),
                        TextEntry::make('cc_dc_bpt_constructed')->label('CC/DC/BPT (Const)')->badge()->color('success'),

                        // Pair 2: Distribution Line
                        TextEntry::make('distribution_line_planned')->label('Dist. Line (Plan)')->badge()->color('gray'),
                        TextEntry::make('distribution_line_constructed')->label('Dist. Line (Const)')->badge()->color('success'),

                        // Pair 3: Other Structures
                        TextEntry::make('other_structures_planned')->label('Other (Plan)')->badge()->color('gray'),
                        TextEntry::make('other_structures_constructed')->label('Other (Const)')->badge()->color('success'),
                    ]),

                // --- 3. Tap Connections & Private Lines ---
                Section::make('Tap Connections & Private Lines')
                    ->icon('heroicon-m-home-modern')
                    ->columns(4)
                    ->schema([
                        // Pair 1: Public Taps
                        TextEntry::make('public_taps_planned')->label('Public (Plan)')->badge()->color('gray'),
                        TextEntry::make('public_taps_constructed')->label('Public (Const)')->badge()->color('success'),

                        // Pair 2: School Taps
                        TextEntry::make('school_taps_planned')->label('School (Plan)')->badge()->color('gray'),
                        TextEntry::make('school_taps_constructed')->label('School (Const)')->badge()->color('success'),

                        // Pair 3: Private Taps
                        TextEntry::make('private_taps_planned')->label('Pvt Taps (Plan)')->badge()->color('gray'),
                        TextEntry::make('private_taps_constructed')->label('Pvt Taps (Const)')->badge()->color('success'),

                        // Pair 4: Private Lines
                        TextEntry::make('private_line_planned')->label('Pvt Line (Plan)')->badge()->color('gray'),
                        TextEntry::make('private_line_constructed')->label('Pvt Line (Const)')->badge()->color('success'),
                    ]),

                // --- 4. Notes ---
                Section::make('Additional Information')
                    ->icon('heroicon-m-document-text')
                    ->schema([
                        TextEntry::make('remarks')
                            ->label('Remarks / Observations')
                            ->placeholder('No remarks recorded.')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }
}