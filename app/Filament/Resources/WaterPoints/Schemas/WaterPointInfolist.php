<?php

namespace App\Filament\Resources\WaterPoints\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Support\Enums\FontWeight;
use Filament\Schemas\Schema;

class WaterPointInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        
                        // --- SECTION 1: LINKING (Scheme) ---
                        Section::make('Scheme Association')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextEntry::make('scheme_code')
                                        ->label('Scheme Code')
                                        ->icon('heroicon-m-hashtag')
                                        ->copyable(),
                                    
                                    // Assuming relationship exists, showing name is helpful
                                    TextEntry::make('scheme.scheme_name')
                                        ->label('Scheme Name')
                                        ->icon('heroicon-m-identification')
                                        ->placeholder('No Scheme Linked'),
                                ]),
                            ]),

                        // --- SECTION 2: IDENTIFICATION ---
                        Section::make('General Information')
                            ->schema([
                                Grid::make(3)->schema([
                                    TextEntry::make('water_point_name')
                                        ->label('Water Point / Owner')
                                        ->weight(FontWeight::Bold)
                                        ->columnSpan(2),

                                    TextEntry::make('location_type')
                                        ->badge()
                                        ->color('info'),

                                    TextEntry::make('tole')
                                        ->label('Tole / Cluster')
                                        ->icon('heroicon-m-map-pin'),

                                    TextEntry::make('ward_no')
                                        ->label('Ward No')
                                        ->badge()
                                        ->color('gray'),

                                    TextEntry::make('tap_construction_status')
                                        ->label('Construction Complete?')
                                        ->badge()
                                        ->color(fn (string $state): string => match (strtolower($state)) {
                                            'yes' => 'success',
                                            'no' => 'danger',
                                            default => 'warning',
                                        }),
                                ]),
                            ]),

                        // --- SECTION 3: SOCIO-ECONOMIC DATA ---
                        Section::make('Socio-Economic Profile')
                            ->schema([
                                Grid::make(3)->schema([
                                    TextEntry::make('households_count')
                                        ->label('HH Count')
                                        ->icon('heroicon-m-home'),

                                    TextEntry::make('ethnicity')
                                        ->label('Ethnicity')
                                        ->badge()
                                        ->color('warning'),

                                    TextEntry::make('economic_status')
                                        ->label('Economic Status')
                                        ->badge()
                                        ->color(fn (string $state): string => match ($state) {
                                            'Poor', 'Ultra-Poor' => 'danger',
                                            'Non-Poor' => 'success',
                                            default => 'gray',
                                        }),
                                ]),
                            ]),

                        // --- SECTION 4: DEMOGRAPHICS ---
                        Section::make('User Demographics')
                            ->schema([
                                Grid::make(3)->schema([
                                    TextEntry::make('woman')
                                        ->label('Women')
                                        ->icon('heroicon-m-user'),

                                    TextEntry::make('man')
                                        ->label('Men')
                                        ->icon('heroicon-m-user'),

                                    TextEntry::make('total_users')
                                        ->label('Total Users')
                                        ->weight(FontWeight::Bold),
                                ]),
                            ]),

                        // --- SECTION 5: NOTES ---
                        Section::make('Additional Info')
                            ->collapsed()
                            ->schema([
                                TextEntry::make('remarks')
                                    ->markdown()
                                    ->prose()
                                    ->placeholder('No remarks provided.'),
                            ]),

                    ])->columnSpanFull(),
            ]);
    }
}