<?php

namespace App\Filament\Resources\Trainings\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Schema; // Keeping your custom Schema class usage

class TrainingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                
                // --- SECTION 1: OVERVIEW ---
                Section::make('Training Overview')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('training_type')
                                ->label('Level'),
                            TextEntry::make('training_name')
                                ->label('Name')
                                ->columnSpan(2),

                            TextEntry::make('training_start_date')->date(),
                            TextEntry::make('training_end_date')->date(),
                            TextEntry::make('training_days')->label('Duration (Days)'),

                            TextEntry::make('training_place')->icon('heroicon-m-map-pin'),
                            TextEntry::make('facilitator_name')->icon('heroicon-m-user'),
                            TextEntry::make('num_schemes_participants')->label('No. of Schemes'),
                        ]),
                    ]),

                // --- SECTION 2: ATTENDANCE METRICS ---
                Section::make('Attendance Metrics')
                    ->schema([
                        Grid::make(4)->schema([
                            TextEntry::make('num_participating_schools')->label('Schools'),
                            TextEntry::make('teacher_count')->label('Teachers'),
                            TextEntry::make('child_club_count')->label('Child Clubs'),
                            TextEntry::make('school_mgmt_committee_count')->label('SMC Members'),
                        ]),
                    ]),

                // --- SECTION 3: DEMOGRAPHICS BREAKDOWN ---
                Section::make('Demographics Breakdown')
                    ->schema([
                        // The Matrix (Ethnicity x Gender)
                        Grid::make(6)->schema([
                            TextEntry::make('dalit_male')->label('Dalit (M)'),
                            TextEntry::make('dalit_female')->label('Dalit (F)'),
                            
                            TextEntry::make('janjati_male')->label('Janjati (M)'),
                            TextEntry::make('janjati_female')->label('Janjati (F)'),

                            TextEntry::make('other_male')->label('Other (M)'),
                            TextEntry::make('other_female')->label('Other (F)'),
                        ]),

                        // Totals Row
                        Grid::make(3)->schema([
                            TextEntry::make('male_total')->label('Total Males')->weight('bold'),
                            TextEntry::make('female_total')->label('Total Females')->weight('bold'),
                            TextEntry::make('total')->label('Grand Total')
                                ->weight('bold')
                                ->color('primary'),
                        ]),
                    ]),

                // --- SECTION 4: PARTICIPANTS LIST ---
                Section::make('Participants List')
                    ->collapsible()
                    ->schema([
                        RepeatableEntry::make('participants')
                            ->hiddenLabel()
                            ->schema([
                                Grid::make(4)->schema([
                                    TextEntry::make('full_name')->weight('bold'),
                                    TextEntry::make('address')->icon('heroicon-m-home'),
                                    TextEntry::make('phone')->icon('heroicon-m-phone'),
                                    TextEntry::make('school_name'),
                                ]),
                            ]),
                    ]),

                // --- META DATA ---
                Section::make('Record Info')
                    ->collapsed()
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('created_at')->dateTime(),
                            TextEntry::make('updated_at')->dateTime(),
                            TextEntry::make('scheme_id')->label('Scheme ID'),
                        ]),
                    ]),
            ]);
    }
}