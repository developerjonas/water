<?php

namespace App\Filament\Resources\GpsPhotos\Schemas;

// use App\Models\Scheme;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

use App\Models\Scheme;
use App\Models\Province;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Donor;
class GpsPhotoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    // Step 1: Scheme & Formation
                    Wizard\Step::make('Scheme & Formation')
                        ->schema([
                            Select::make('province')
                                ->label('Province')
                                ->options(Province::pluck('name', 'id'))
                                ->reactive()
                                ->required()
                                ->afterStateUpdated(fn($state, callable $set) => $set('district', null)),

                            Select::make('district')
                                ->label('District')
                                ->options(function (callable $get) {
                                    $provinceId = $get('province');
                                    return $provinceId ? District::where('province_id', $provinceId)->pluck('name', 'id') : [];
                                })
                                ->reactive()
                                ->afterStateUpdated(fn($state, callable $set) => $set('municipality', null))
                                ->required(),

                            Select::make('municipality')
                                ->label('Municipality')
                                ->options(function (callable $get) {
                                    $districtId = $get('district');
                                    return $districtId ? Municipality::where('district_id', $districtId)->pluck('name', 'id') : [];
                                })
                                ->reactive()
                                ->required(),

                            Select::make('donor')
                                ->label('Donor')
                                ->options(Donor::pluck('name', 'id'))
                                ->nullable()
                                ->reactive(),

                            Select::make('scheme_code')
                                ->label('Scheme Code')
                                ->options(function (callable $get) {
                                    $province = $get('province');
                                    $district = $get('district');
                                    $mun = $get('municipality');
                                    $donor = $get('donor');

                                    $query = Scheme::query();

                                    if ($province) $query->where('province', $province);
                                    if ($district) $query->where('district', $district);
                                    if ($mun) $query->where('mun', $mun);
                                    if ($donor) $query->whereJsonContains('collaborator', $donor);

                                    return $query->pluck('scheme_code', 'scheme_code');
                                })
                                ->required()
                                ->searchable()
                                ->placeholder('Select Scheme Code')
                                ->helperText('Select the related scheme for this UC'),
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
