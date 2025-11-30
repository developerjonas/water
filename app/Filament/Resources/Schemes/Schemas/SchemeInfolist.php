<?php

namespace App\Filament\Resources\Schemes\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;

class SchemeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                
                // --- LEFT COLUMN (Wide - 2/3) ---
                Group::make()
                    ->columnSpan(['lg' => 2])
                    ->schema([
                        
                        // 1. Identity & Location
                        Section::make('Scheme Overview')
                            ->icon('heroicon-m-information-circle')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextEntry::make('scheme_name')
                                        ->label('Scheme Name (English)')
                                        ->weight('bold') // String instead of Enum
                                        ->size('lg'),    // String instead of Enum
                                    
                                    TextEntry::make('scheme_name_np')
                                        ->label('Scheme Name (Nepali)'),
                                ]),

                                Grid::make(4)->schema([
                                    TextEntry::make('province')
                                        ->label('Province'),
                                    TextEntry::make('district')
                                        ->label('District'),
                                    TextEntry::make('mun')
                                        ->label('Municipality'),
                                    TextEntry::make('ward_no')
                                        ->label('Ward')
                                        ->badge(), // Simple badge
                                ]),

                                TextEntry::make('scheme_code')
                                    ->label('Scheme Code')
                                    ->copyable()
                                    ->color('gray'),
                            ]),

                        // 2. Dates
                        Section::make('Timeline')
                            ->icon('heroicon-m-calendar')
                            ->schema([
                                Grid::make(3)->schema([
                                    TextEntry::make('agreement_signed_date')->date(),
                                    TextEntry::make('started_date')->date(),
                                    TextEntry::make('schedule_end_date')->date(),
                                    TextEntry::make('planned_completion_date')->date(),
                                    TextEntry::make('actual_completed_date')->date(),
                                    TextEntry::make('completion_date')
                                        ->label('Final Report')
                                        ->date()
                                        ->color('success')
                                        ->weight('bold'),
                                ]),
                            ]),
                    ]),

                // --- RIGHT COLUMN (Narrow - 1/3) ---
                Group::make()
                    ->columnSpan(['lg' => 1])
                    ->schema([
                        
                        // 3. Status & Classifications
                        Section::make('Status & Type')
                            ->schema([
                                TextEntry::make('progress_status')
                                    ->badge()
                                    ->color('primary'), // Simple string color

                                TextEntry::make('sector'),
                                TextEntry::make('scheme_technology'),
                                TextEntry::make('scheme_type'),
                                TextEntry::make('scheme_construction_type'),
                                TextEntry::make('scheme_start_year'),
                            ]),

                        // 4. Boolean Flags
                        Section::make('Indicators')
                            ->schema([
                                IconEntry::make('source_registration_status')
                                    ->label('Source Registered')
                                    ->boolean(),
                                
                                IconEntry::make('source_conservation')
                                    ->label('Source Conservation')
                                    ->boolean(),

                                IconEntry::make('no_subscheme')
                                    ->label('Is Standalone')
                                    ->boolean(),
                            ]),
                    ]),

            ])
            ->columns(3); // This enables the 2 + 1 layout
    }
}