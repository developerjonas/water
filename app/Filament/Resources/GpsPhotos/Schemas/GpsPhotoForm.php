<?php

namespace App\Filament\Resources\GpsPhotos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use App\Filament\Components\SchemeSelector;

class GpsPhotoForm
{
    public static function configure(Schema $form): Schema
    {
        return $form
            ->components([
                Section::make('Scheme & System Configuration')->columnSpanFull()->columns(3)
                    ->schema([
                        ...SchemeSelector::make(),

                    ]),
                // Section: Core Info
                Section::make('System Configuration')
                    ->description('Identify the scheme and hardware details.')
                    ->icon('heroicon-m-building-office-2')
                    ->schema([
                        TextInput::make('water_system_name')
                            ->label('System Name')
                            ->placeholder('e.g. Chisapani Project A')
                            ->required()
                            ->columnSpanFull(),

                        Select::make('location_type')
                            ->searchable()
                            ->native(false)
                            ->options([
                                'Community' => 'Community',
                                'School Health Center/Clinic' => 'School Health Center/Clinic',
                                'Public Institutions' => 'Public Institutions',
                            ]),

                        Select::make('source_type')
                            ->searchable()
                            ->native(false)
                            ->options([
                                'Spring To Gravity Flow' => 'Spring To Gravity Flow',
                                'Spring To Solar Pump' => 'Spring To Solar Pump',
                            ]),

                        Select::make('hardware_type')
                            ->searchable()
                            ->native(false)
                            ->options([
                                'Community Tap Stand(s)' => 'Community Tap Stand(s)',
                                'On-Plot Tap Stand(s)' => 'On-Plot Tap Stand(s)',
                            ])
                            ->columnSpanFull(),

                    ]),
                // Section: Visual Evidence
                Section::make('Visual Evidence')
                    ->icon('heroicon-m-camera')
                    ->collapsible()
                    ->schema([
                        FileUpload::make('structure_photos')
                            ->label('Structure Photos')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->reorderable()
                            ->disk('public')
                            ->directory(fn($get, $record) => 'gps-photos/' . ($record?->scheme_code ?? $get('scheme_code')) . '/structures')
                            ->getUploadedFileNameForStorageUsing(fn($file) => $file->hashName())
                            ->columnSpan(1),

                        FileUpload::make('plaque_photos')
                            ->label('Plaque Photos')
                            ->multiple()
                            ->image()
                            ->imageEditor()
                            ->reorderable()
                            ->disk('public')
                            ->directory(fn($get, $record) => 'gps-photos/' . ($record?->scheme_code ?? $get('scheme_code')) . '/plaques')
                            ->getUploadedFileNameForStorageUsing(fn($file) => $file->hashName())
                            ->columnSpan(1),
                    ]),
                // Section: Geolocation
                Section::make('Geolocation')
                    ->icon('heroicon-m-map-pin')
                    ->schema([
                        TextInput::make('latitude')
                            ->numeric()
                            ->placeholder('28.3949')
                            ->required(),

                        TextInput::make('longitude')
                            ->numeric()
                            ->placeholder('84.1240')
                            ->required(),
                    ]),

                // Section: Notes
                Section::make('Additional Notes')
                    ->icon('heroicon-m-pencil-square')
                    ->schema([
                        Textarea::make('remarks')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);






    }
}