<?php

namespace App\Filament\Resources\SanitationMetrics\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;
use Filament\Schemas\Schema;

class SanitationMetricInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                // --- SECTION 1: OVERVIEW & STATUS ---
                Section::make('Metric Overview')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('scheme_code')
                                ->label('Scheme Code')
                                ->icon('heroicon-m-hashtag'),

                            TextEntry::make('total_sanitation_status')
                                ->label('Declaration Status')
                                ->badge()
                                ->color(fn (string $state): string => match ($state) {
                                    'yes' => 'success',
                                    'no' => 'danger',
                                    'partial' => 'warning',
                                    default => 'gray',
                                })
                                ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                            TextEntry::make('remarks')
                                ->label('Remarks')
                                ->columnSpan(1)
                                ->placeholder('No remarks provided.'),
                        ]),
                    ]),

                // --- SECTION 2: HOUSEHOLD FACILITIES GRID ---
                Section::make('Household Facilities Counts')
                    ->schema([
                        Grid::make(3)->schema([
                            
                            // Highlight the Total
                            TextEntry::make('households_total')
                                ->label('Total Households')
                                ->weight(FontWeight::Bold)
                                ->color('primary'),

                            TextEntry::make('households_with_toilet')
                                ->label('With Toilet')
                                ->icon('heroicon-m-check-circle'),

                            TextEntry::make('households_with_handwashing_station')
                                ->label('With Handwashing Station')
                                ->icon('heroicon-m-hand-raised'),

                            TextEntry::make('households_with_drying_rack')
                                ->label('With Drying Rack')
                                ->icon('heroicon-m-sun'),

                            TextEntry::make('households_using_filter')
                                ->label('Using Water Filter')
                                ->icon('heroicon-m-funnel'),

                            TextEntry::make('households_with_waste_disposal_pit')
                                ->label('With Waste Disposal Pit')
                                ->icon('heroicon-m-trash'),
                        ]),
                    ]),

                // --- META DATA ---
                Section::make('System Info')
                    ->collapsed()
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('created_at')
                                ->dateTime()
                                ->label('Created On'),
                            TextEntry::make('updated_at')
                                ->dateTime()
                                ->label('Last Updated'),
                        ]),
                    ]),
            ]);
    }
}