<?php

namespace App\Filament\Resources\PublicAudits\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use App\Filament\Components\SchemeSelector;

class PublicAuditForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Wizard::make([
                
                    // Step 1: Scheme & Formation
                    Step::make('Scheme & Formation')
                    ->schema(SchemeSelector::make()),

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
