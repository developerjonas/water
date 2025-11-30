<?php

namespace App\Filament\Resources\Schemes\Schemas;

use App\Models\Province;
use App\Models\District;
use App\Models\Municipality;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class SchemeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                // --- COLUMN 1: Main Info ---
                Group::make()
                    ->columnSpan(['lg' => 2])
                    ->schema([
                        
                        // 1. Location Section (Cascading Logic)
                        Section::make('Geographic Details')
                            ->icon('heroicon-m-map')
                            ->schema([
                                Grid::make(2)->schema([
                                    Select::make('province')
                                        ->label('Province')
                                        ->options(Province::where('is_active', 1)->pluck('name', 'province_code'))
                                        ->searchable()
                                        ->preload()
                                        ->live() // v3/v4 replacement for reactive()
                                        ->afterStateUpdated(function ($set) {
                                            $set('district', null);
                                            $set('mun', null);
                                        })
                                        ->required(),

                                    Select::make('district')
                                        ->label('District')
                                        ->options(function ($get) {
                                            $provinceId = $get('province');
                                            if (!$provinceId) {
                                                return [];
                                            }
                                            return District::where('province_code', $provinceId)
                                                ->where('is_active', 1)
                                                ->pluck('name', 'district_code');
                                        })
                                        ->searchable()
                                        ->preload()
                                        ->live()
                                        ->afterStateUpdated(function ($set) {
                                            $set('mun', null);
                                        })
                                        ->required(),

                                    Select::make('mun')
                                        ->label('Municipality')
                                        ->options(function ($get) {
                                            $districtId = $get('district');
                                            if (!$districtId) {
                                                return [];
                                            }
                                            return Municipality::where('district_code', $districtId)
                                                ->where('is_active', 1)
                                                ->pluck('name', 'municipality_code');
                                        })
                                        ->searchable()
                                        ->preload()
                                        ->required(),

                                    TextInput::make('ward_no')
                                        ->label('Ward No')
                                        ->numeric()
                                        ->required(),
                                ]),
                            ]),

                        // 2. General Information Section
                        Section::make('Scheme Details')
                            ->icon('heroicon-m-identification')
                            ->columns(2)
                            ->schema([
                                TextInput::make('scheme_code')
                                    ->required()
                                    ->maxLength(255),
                                
                                TextInput::make('collaborator')
                                    ->placeholder('Partner Organization'),
                                    
                                TextInput::make('scheme_name')
                                    ->label('Name (English)')
                                    ->required()
                                    ->columnSpanFull(),
                                    
                                TextInput::make('scheme_name_np')
                                    ->label('Name (Nepali)')
                                    ->columnSpanFull(),

                                Textarea::make('justification_for_delay')
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ]),

                        // 3. Dates / Timeline Section
                        Section::make('Timeline')
                            ->icon('heroicon-m-calendar')
                            ->collapsed()
                            ->schema([
                                Grid::make(3)->schema([
                                    DatePicker::make('agreement_signed_date')->native(false),
                                    DatePicker::make('started_date')->native(false),
                                    DatePicker::make('schedule_end_date')->native(false),
                                    DatePicker::make('planned_completion_date')->native(false),
                                    DatePicker::make('actual_completed_date')->native(false),
                                    DatePicker::make('completion_date')->native(false)->label('Final Report Date'),
                                ]),
                            ]),
                    ]),

                // --- COLUMN 2: Sidebar (Settings & Status) ---
                Group::make()
                    ->columnSpan(['lg' => 1])
                    ->schema([
                        
                        Section::make('Classification')
                            ->icon('heroicon-m-tag')
                            ->schema([
                                TextInput::make('sector'),
                                TextInput::make('scheme_technology'),
                                TextInput::make('scheme_type')
                                    ->required()
                                    ->default('DWS'),
                                TextInput::make('scheme_construction_type')
                                    ->required()
                                    ->default('New'),
                                TextInput::make('scheme_start_year')
                                    ->numeric()
                                    ->required(),
                                TextInput::make('progress_status'),
                            ]),

                        Section::make('Status Flags')
                            ->icon('heroicon-m-check-circle')
                            ->schema([
                                Toggle::make('source_registration_status')
                                    ->onColor('success'),
                                Toggle::make('source_conservation')
                                    ->onColor('success'),
                                Toggle::make('no_subscheme')
                                    ->label('Is Standalone Scheme')
                                    ->onColor('primary'),
                            ]),
                    ]),
            ])
            ->columns(3); // Creates a 2/3 + 1/3 layout
    }
}