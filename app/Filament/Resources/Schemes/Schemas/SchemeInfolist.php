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
                
                // --- COLUMN 1: Main Content (2/3 Width) ---
                Group::make()
                    ->columnSpan(['lg' => 2])
                    ->schema([
                        
                        // 1. Identity & Overview
                        Section::make('Scheme Overview')
                            ->icon('heroicon-m-identification')
                            ->schema([
                                // Top Row: Codes
                                Grid::make(2)->schema([
                                    TextEntry::make('scheme_code') // System Auto-Generated
                                        ->label('System Code')
                                        ->icon('heroicon-m-qr-code')
                                        ->copyable()
                                        ->color('gray')
                                        ->weight('bold'),

                                    TextEntry::make('scheme_code_user') // Manual Input
                                        ->label('Scheme Code')
                                        ->copyable(),
                                ]),

                                // Middle Row: Names
                                Grid::make(1)->schema([
                                    TextEntry::make('scheme_name')
                                        ->label('Scheme Name (English)')
                                        ->size('lg')
                                        ->weight('bold'),
                                        
                                    TextEntry::make('scheme_name_np')
                                        ->label('Scheme Name (Nepali)'),
                                ]),

                                // Bottom Row: Collaborator
                                TextEntry::make('collaborator')
                                    ->label('Partner / Collaborator')
                                    ->icon('heroicon-m-users'),
                            ]),

                        // 2. Geographic Location
                        Section::make('Geographic Details')
                            ->icon('heroicon-m-map')
                            ->schema([
                                Grid::make(4)->schema([
                                    // Assuming you have relationships set up in your Scheme Model 
                                    // (e.g., public function province() { return $this->belongsTo(Province::class); })
                                    TextEntry::make('province') 
                                        ->label('Province'),
                                        
                                    TextEntry::make('district')
                                        ->label('District'),
                                        
                                    TextEntry::make('mun') // Or 'mun.name' depending on your relation name
                                        ->label('Municipality'),
                                        
                                    TextEntry::make('ward_no')
                                        ->label('Ward')
                                        ->badge(),
                                ]),
                            ]),

                        // 3. Timeline & Dates
                        Section::make('Timeline & Justification')
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
                                        ->color('success'),
                                ]),
                                
                                TextEntry::make('scheme_start_year')
                                    ->label('Fiscal Start Year')
                                    ->badge()
                                    ->color('gray'),

                                TextEntry::make('justification_for_delay')
                                    ->label('Justification for Delay')
                                    ->markdown() // Renders nicely if they typed a lot
                                    ->placeholder('No delays recorded.')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                // --- COLUMN 2: Sidebar (1/3 Width) ---
                Group::make()
                    ->columnSpan(['lg' => 1])
                    ->schema([
                        
                        // 4. Classification
                        Section::make('Classification')
                            ->icon('heroicon-m-tag')
                            ->schema([
                                TextEntry::make('progress_status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'Completed' => 'success',
                                        'Ongoing' => 'warning',
                                        default => 'gray',
                                    }),

                                TextEntry::make('scheme_type') // DWS / MUS
                                    ->label('Scheme Sector')
                                    ->badge()
                                    ->color('info'),

                                TextEntry::make('scheme_technology')
                                    ->label('Technology')
                                    ->icon('heroicon-m-cpu-chip'),

                                TextEntry::make('sector')
                                    ->label('Broad Sector'),

                                TextEntry::make('scheme_construction_type')
                                    ->label('Construction Type')
                                    ->badge(),

                                TextEntry::make('no_of_subschemes')
                                    ->label('Sub-schemes')
                                    ->numeric(),
                            ]),

                        // 5. Status Flags
                        Section::make('Indicators')
                            ->schema([
                                IconEntry::make('source_registration_status')
                                    ->label('Source Registered')
                                    ->boolean(),

                                IconEntry::make('source_conservation')
                                    ->label('Source Conservation')
                                    ->boolean(),

                                IconEntry::make('no_subscheme')
                                    ->label('Standalone (No Sub)')
                                    ->boolean(),
                            ]),
                            
                        // 6. Metadata (Optional but recommended)
                        Section::make('System Info')
                            ->collapsed()
                            ->schema([
                                TextEntry::make('created_at')->dateTime(),
                                TextEntry::make('updated_at')->dateTime(),
                            ]),
                    ]),
            ])
            ->columns(3);
    }
}