<?php

namespace App\Filament\Resources\WaterQualityTests\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;
use Filament\Schemas\Schema;

class WaterQualityTestInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->columnSpan(['lg' => 2])
                    ->schema([
                        
                        // --- SECTION 1: CONTEXT ---
                        Section::make('Test Context')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextEntry::make('scheme.scheme_name')
                                        ->label('Scheme Name')
                                        ->icon('heroicon-m-home-modern')
                                        ->weight(FontWeight::Bold),

                                    TextEntry::make('scheme_code')
                                        ->label('System Code')
                                        ->icon('heroicon-m-hashtag')
                                        ->copyable(),
                                ]),
                                Grid::make(3)->schema([
                                    // Shows linked asset name OR the manual text input
                                    TextEntry::make('tested_point_name')
                                        ->label('Sample Point')
                                        ->icon('heroicon-m-map-pin')
                                        ->placeholder(fn ($record) => $record->waterPoint?->water_point_name ?? 'N/A'),

                                    TextEntry::make('test_date')
                                        ->label('Date Tested')
                                        ->date('d M Y')
                                        ->icon('heroicon-m-calendar'),

                                    TextEntry::make('created_at')
                                        ->label('Record Created')
                                        ->dateTime()
                                        ->color('gray'),
                                ]),
                            ]),

                        // --- SECTION 2: BIOLOGICAL RESULTS ---
                        Section::make('Microbiological Analysis')
                            ->schema([
                                Grid::make(2)->schema([
                                    
                                    // E.COLI
                                    TextEntry::make('ecoli')
                                        ->label('E. coli (CFU/100ml)')
                                        ->weight(FontWeight::Bold)
                                        ->suffix(fn ($record) => " (" . $record->ecoli_risk . ")") // Uses Model Accessor
                                        ->color(fn ($record) => $record->ecoli_color), // Uses Model Accessor

                                    // COLIFORM
                                    TextEntry::make('coliform')
                                        ->label('Total Coliform')
                                        ->weight(FontWeight::Bold)
                                        ->suffix(fn ($record) => " (" . $record->coliform_risk . ")")
                                        ->color(fn ($record) => match(true) {
                                            $record->coliform == 0 => 'success',
                                            $record->coliform <= 10 => 'info',
                                            $record->coliform <= 100 => 'warning',
                                            default => 'danger',
                                        }),
                                ]),
                            ]),

                        // --- SECTION 3: CHEMICAL RESULTS ---
                        Section::make('Physical & Chemical Analysis')
                            ->schema([
                                Grid::make(3)->schema([
                                    
                                    // pH
                                    TextEntry::make('ph')
                                        ->label('pH Level')
                                        ->suffix(' pH')
                                        ->badge()
                                        ->color(fn ($record) => $record->ph_status === 'Compliant' ? 'success' : 'danger')
                                        ->icon(fn ($record) => $record->ph_status === 'Compliant' ? 'heroicon-m-check-circle' : 'heroicon-m-exclamation-circle'),

                                    // Turbidity
                                    TextEntry::make('turbidity')
                                        ->label('Turbidity')
                                        ->suffix(' NTU')
                                        ->badge()
                                        ->color(fn ($record) => $record->turbidity_status === 'Compliant' ? 'success' : 'danger'),

                                    // FRC
                                    TextEntry::make('frc')
                                        ->label('FRC (Chlorine)')
                                        ->suffix(' mg/L')
                                        ->badge()
                                        ->color(fn ($record) => $record->frc_status === 'Adequate' ? 'success' : 'warning'),
                                ]),
                            ]),
                    ]),

                Group::make()
                    ->columnSpan(['lg' => 1])
                    ->schema([
                        // --- SECTION 4: NOTES ---
                        Section::make('Remarks')
                            ->schema([
                                TextEntry::make('remarks')
                                    ->markdown()
                                    ->prose()
                                    ->placeholder('No observations recorded.'),
                            ]),
                            
                        // --- META ---
                        Section::make('System Info')
                            ->collapsed()
                            ->schema([
                                TextEntry::make('updated_at')->dateTime(),
                                TextEntry::make('id')->label('Record ID'),
                            ]),
                    ]),
            ])
            ->columns(3);
    }
}