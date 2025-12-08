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

                Group::make()
                    ->columnSpan(['lg' => 2])
                    ->schema([
                        Section::make('Geographic Details')
                            ->icon('heroicon-m-map')
                            ->schema([
                                Grid::make(2)->schema([
                                    Select::make('province')
                                        ->label('Province')
                                        ->options(Province::where('is_active', 1)->pluck('name', 'province_code'))
                                        ->searchable()
                                        ->preload()
                                        ->live()
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
                                        ->required(),
                                ]),
                            ]),

                        // 2. General Information Section
                        Section::make('Scheme Details')
                            ->icon('heroicon-m-identification')
                            ->columns(2)
                            ->schema([
                                TextInput::make('scheme_code_user')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('colaborator')
                                    ->maxLength(255),
                                TextInput::make('scheme_name')
                                    ->label('Name (English)')
                                    ->required()
                                    ->columnSpanFull(),
                                TextInput::make('scheme_name_np')
                                    ->label('Name (Nepali)')
                                    ->columnSpanFull(),
                               
                            ]),

                        // 3. Dates / Timeline Section
                        Section::make('Timeline')
                            ->icon('heroicon-m-calendar')
                            ->collapsed()
                            ->schema([
                                Grid::make(3)->schema([
                                    DatePicker::make('started_date')->native(false),
                                    DatePicker::make('planned_completion_date')->native(false),
                                    DatePicker::make('actual_completed_date')->native(false),
                                    Textarea::make('justification_for_delay')
                                        ->rows(3)
                                        ->columnSpanFull(),
                                ]),
                            ]),
                    ]),

                Group::make()
                    ->columnSpan(['lg' => 1])
                    ->schema([

                        Section::make('Classification')
                            ->icon('heroicon-m-tag')
                            ->schema([
                                TextInput::make('no_of_sub_schemes')
                                    ->required(),
                                Select::make('sector')
                                    ->label('Sector')
                                    ->options([
                                        'DWS' => 'DWS',
                                        'MUS' => 'MUS',
                                    ]),
                                Select::make('scheme_construction_type')
                                    ->required()
                                    ->label('Scheme Construction')
                                    ->default('New')
                                    ->options([
                                        'New' => 'New',
                                        'Rehab' => 'Rehab',
                                    ]),
                                Select::make('scheme_technology')
                                    ->label('Technology')
                                    ->options([
                                        'Solar Lift' => 'Solar Lift',
                                        'Gravity' => 'Gravity',
                                    ]),
                            ]),

                        Section::make('Status Flags')
                            ->icon('heroicon-m-check-circle')
                            ->schema([
                                Toggle::make('source_registration_status')
                                    ->onColor('success'),
                                Toggle::make('source_conservation')
                                    ->onColor('success'),
                                Select::make('progress_status')
                                    ->required()
                                    ->label('Progress Status')
                                    ->default('Completed')
                                    ->options([
                                        'Completed' => 'Completed',
                                        'Ongoing' => 'Ongoing',
                                    ]),

                            ]),
                    ]),
            ])
            ->columns(3);
    }
}