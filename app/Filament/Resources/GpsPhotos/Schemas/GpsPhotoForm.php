<?php

namespace App\Filament\Resources\GpsPhotos\Schemas;

use App\Models\Scheme;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class GpsPhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Scheme Info')
                        ->schema([
                            Section::make('Select Scheme')
                                ->schema([
                                    Select::make('scheme_code')
                                        ->label('Scheme Name')
                                        ->searchable()
                                        ->required()
                                        ->options(
                                            fn() => Scheme::orderBy('scheme_name')
                                                ->pluck('scheme_name', 'scheme_code')
                                                ->toArray()
                                        ),
                                    TextInput::make('scheme_name')
                                        ->hidden()
                                        ->default(fn($get) => Scheme::where('scheme_code', $get('scheme_code'))->value('scheme_name')),
                                ]),
                        ]),

                    Step::make('Water System Info')
                        ->schema([
                            Section::make('Water System Details')
                                ->schema([
                                    Grid::make(2)->schema([
                                        TextInput::make('water_system_name')
                                            ->required()
                                            ->columnSpan(1),
                                        Select::make('location_type')
                                            ->label('Location Type')
                                            ->options([
                                                'Community' => 'Community',
                                                'School Health Center/Clinic' => 'School Health Center/Clinic',
                                                'Public Institutions' => 'Public Institutions',
                                            ])
                                            ->columnSpan(1),
                                        Select::make('source_type')
                                            ->label('Source Type')
                                            ->options([
                                                'Spring To Gravity Flow' => 'Spring To Gravity Flow',
                                                'Spring To Solar Pump' => 'Spring To Solar Pump',
                                            ])
                                            ->columnSpan(1),
                                        Select::make('hardware_type')
                                            ->label('Hardware Type')
                                            ->options([
                                                'Community Tap Stand(s)' => 'Community Tap Stand(s)',
                                                'On-Plot Tap Stand(s)' => 'On-Plot Tap Stand(s)',
                                            ])
                                            ->columnSpan(1),
                                    ]),
                                ]),
                        ]),

                    Step::make('Photos & Location')
                        ->schema([
                            Section::make('Photos / Plaques')
                                ->schema([
                                    FileUpload::make('structure_photos')
                                        ->label('Structure Photos')
                                        ->multiple()
                                        ->disk('public')
                                        ->directory(fn($get, $record) => 'gps-photos/' . ($record?->scheme_code ?? $get('scheme_code')) . '/structures')
                                        ->getUploadedFileNameForStorageUsing(fn($file) => $file->hashName()),

                                    FileUpload::make('plaque_photos')
                                        ->label('Plaque Photos')
                                        ->multiple()
                                        ->disk('public')
                                        ->directory(fn($get, $record) => 'gps-photos/' . ($record?->scheme_code ?? $get('scheme_code')) . '/plaques')
                                        ->getUploadedFileNameForStorageUsing(fn($file) => $file->hashName()),

                                    Grid::make(2)->schema([
                                        TextInput::make('latitude')
                                            ->label('Latitude')
                                            ->numeric()
                                            ->placeholder('e.g. 28.3949')
                                            ->required()
                                            ->columnSpan(1),

                                        TextInput::make('longitude')
                                            ->label('Longitude')
                                            ->numeric()
                                            ->placeholder('e.g. 84.1240')
                                            ->required()
                                            ->columnSpan(1),
                                    ]),
                                    TextInput::make('remarks')
                                        ->label('Remarks')
                                        ->columnSpanFull(),
                                ]),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
