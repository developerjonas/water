<?php

namespace App\Filament\Resources\PublicAudits\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
// use App\Models\Scheme;
use App\Models\Scheme;
use App\Models\Province;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Donor;

class PublicAuditForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
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

                Step::make('Audit Info')
                    ->schema([
                        TextInput::make('audit_type')
                            ->label('Audit Type')
                            ->placeholder('e.g. Public Audit - I')
                            ->required(),

                        DatePicker::make('audit_date')
                            ->label('Audit Date')
                            ->required(),

                        TextInput::make('participant_counts.dalit_female')
                            ->label('Dalit Female')
                            ->numeric()
                            ->default(0),
                        TextInput::make('participant_counts.dalit_male')
                            ->label('Dalit Male')
                            ->numeric()
                            ->default(0),
                        TextInput::make('participant_counts.janjati_female')
                            ->label('Janjati Female')
                            ->numeric()
                            ->default(0),
                        TextInput::make('participant_counts.janjati_male')
                            ->label('Janjati Male')
                            ->numeric()
                            ->default(0),
                        TextInput::make('participant_counts.other_female')
                            ->label('Other Female')
                            ->numeric()
                            ->default(0),
                        TextInput::make('participant_counts.other_male')
                            ->label('Other Male')
                            ->numeric()
                            ->default(0),

                        TextInput::make('total')
                            ->label('Total Participants')
                            ->numeric()
                            ->disabled()
                            ->default(0)
                            ->afterStateUpdated(function ($set, $get) {
                                $counts = $get('participant_counts') ?? [];
                                $total = array_sum($counts);
                                $set('total', $total);
                            }),

                        FileUpload::make('audit_documents')
                            ->label('Upload Scanned Public Audit Documents')
                            ->multiple()
                            ->disk('public')
                            ->directory(fn($get) => 'public-audits/' . $get('scheme_code'))
                            ->getUploadedFileNameForStorageUsing(fn($file) => $file->hashName()),
                    ]),
            ]),
        ]);
    }
}
