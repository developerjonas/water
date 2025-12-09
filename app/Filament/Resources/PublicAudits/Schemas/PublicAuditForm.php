<?php

namespace App\Filament\Resources\PublicAudits\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use App\Filament\Components\SchemeSelector;

class PublicAuditForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        
                        // --- SECTION 1: SCHEME CONTEXT ---
                        Section::make('Scheme Context')->columns(3)
                            ->description('Link this audit to a specific scheme.')
                            ->schema([
                                ...SchemeSelector::make(),
                            ]),

                        // --- SECTION 2: AUDIT DETAILS ---
                        Section::make('Audit Information')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('audit_type')
                                        ->label('Audit Type / Phase')
                                        ->placeholder('e.g. Public Audit - I (Design Phase)')
                                        ->required(),

                                    DatePicker::make('audit_date')
                                        ->label('Date Conducted')
                                        ->default(now())
                                        ->maxDate(now())
                                        ->required(),
                                ]),
                            ]),

                        // --- SECTION 3: PARTICIPATION (Demographics) ---
                        Section::make('Participant Demographics')
                            ->description('Enter the headcount by ethnicity and gender.')
                            ->schema([
                                Grid::make(3)->schema([
                                    // Row 1: Dalit
                                    TextInput::make('participant_counts.dalit_female')
                                        ->label('Dalit (Female)')
                                        ->numeric()->default(0)->live()->afterStateUpdated(fn(Set $set, Get $get) => self::updateTotal($set, $get)),
                                        
                                    TextInput::make('participant_counts.dalit_male')
                                        ->label('Dalit (Male)')
                                        ->numeric()->default(0)->live()->afterStateUpdated(fn(Set $set, Get $get) => self::updateTotal($set, $get)),

                                    // Row 2: Janjati
                                    TextInput::make('participant_counts.janjati_female')
                                        ->label('Janjati (Female)')
                                        ->numeric()->default(0)->live()->afterStateUpdated(fn(Set $set, Get $get) => self::updateTotal($set, $get)),
                                        
                                    TextInput::make('participant_counts.janjati_male')
                                        ->label('Janjati (Male)')
                                        ->numeric()->default(0)->live()->afterStateUpdated(fn(Set $set, Get $get) => self::updateTotal($set, $get)),

                                    // Row 3: Others
                                    TextInput::make('participant_counts.other_female')
                                        ->label('Other (Female)')
                                        ->numeric()->default(0)->live()->afterStateUpdated(fn(Set $set, Get $get) => self::updateTotal($set, $get)),
                                        
                                    TextInput::make('participant_counts.other_male')
                                        ->label('Other (Male)')
                                        ->numeric()->default(0)->live()->afterStateUpdated(fn(Set $set, Get $get) => self::updateTotal($set, $get)),
                                ]),

                                // Total Row
                                TextInput::make('total')
                                    ->label('Total Participants')
                                    ->numeric()
                                    ->readOnly()
                                    ->prefix('Σ')
                                    ->extraInputAttributes(['class' => 'font-bold text-lg bg-gray-50']),
                            ]),

                        // --- SECTION 4: EVIDENCE ---
                        Section::make('Documents')
                            ->collapsed()
                            ->schema([
                                FileUpload::make('audit_documents')
                                    ->label('Scanned Minutes / Attendance')
                                    ->multiple()
                                    ->disk('public')
                                    ->directory('public-audits')
                                    ->openable()
                                    ->downloadable()
                                    ->columnSpanFull(),
                            ]),

                    ])->columnSpanFull(),
            ]);
    }

    // Helper to calculate total dynamically
    protected static function updateTotal(Set $set, Get $get): void
    {
        $counts = $get('participant_counts') ?? [];
        
        // Sum all values in the array, casting to int ensuring 0 if empty
        $total = array_reduce($counts, fn($carry, $item) => $carry + (int)$item, 0);
        
        $set('total', $total);
    }
}