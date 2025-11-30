<?php

namespace App\Filament\Resources\UserCommittees\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;

class UserCommitteeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                
                // --- Context ---
                Section::make('Scheme Association')
                    ->icon('heroicon-m-link')
                    ->compact()
                    ->columns(3)
                    ->schema([
                        TextEntry::make('scheme.scheme_name')->label('Scheme Name')->weight('bold'),
                        TextEntry::make('scheme.scheme_code_user')->label('Code')->copyable(),
                        TextEntry::make('scheme.district')->label('District'),
                    ])
                    ->columnSpanFull(),

                // --- Main Info ---
                Group::make()
                    ->columnSpan(['lg' => 3])
                    ->schema([
                        Section::make('General Information')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('user_committee_name')->label('Committee Name')->weight('bold')->columnSpanFull(),
                                TextEntry::make('date_of_formation')->date()->icon('heroicon-m-calendar'),
                                TextEntry::make('user_committee_bank_name')
                                    ->label('Bank Name'),
                                TextEntry::make('user_committee_bank_account_name')->label('Bank Account Name')->icon('heroicon-m-building-library'),
                                TextEntry::make('user_committee_bank_account_number')->label('Account No')->copyable(),
                            ]),

                        Section::make('Key Personnel')
                            ->columns(2)
                            ->schema([
                                TextEntry::make('chair_name')->label('Chairperson'),
                                TextEntry::make('vice_chair_name')->label('Vice-Chair'),
                                TextEntry::make('secretary_name')->label('Secretary'),
                                TextEntry::make('treasurer_name')->label('Treasurer'),
                            ]),

                         Section::make('Composition Matrix')
                            ->schema([
                                Grid::make(5)->schema([
                                    TextEntry::make('Label')->state('Dalit')->weight('bold'),
                                    TextEntry::make('dalit_female_key')->label('F-Key')->badge()->color('warning'),
                                    TextEntry::make('dalit_male_key')->label('M-Key')->badge()->color('warning'),
                                    TextEntry::make('dalit_female_member')->label('F-Mem')->badge()->color('success'),
                                    TextEntry::make('dalit_male_member')->label('M-Mem')->badge()->color('success'),
                                ]),
                                Grid::make(5)->schema([
                                    TextEntry::make('Label')->state('Janajati')->weight('bold'),
                                    TextEntry::make('janjati_female_key')->label('F-Key')->badge()->color('warning'),
                                    TextEntry::make('janjati_male_key')->label('M-Key')->badge()->color('warning'),
                                    TextEntry::make('janjati_female_member')->label('F-Mem')->badge()->color('success'),
                                    TextEntry::make('janjati_male_member')->label('M-Mem')->badge()->color('success'),
                                ]),
                                Grid::make(5)->schema([
                                    TextEntry::make('Label')->state('Others')->weight('bold'),
                                    TextEntry::make('others_female_key')->label('F-Key')->badge()->color('warning'),
                                    TextEntry::make('others_male_key')->label('M-Key')->badge()->color('warning'),
                                    TextEntry::make('others_female_member')->label('F-Mem')->badge()->color('success'),
                                    TextEntry::make('others_male_member')->label('M-Mem')->badge()->color('success'),
                                ]),
                            ]),
                    ]),

                // --- Sidebar ---
                Group::make()
                    ->columnSpan(['lg' => 1])
                    ->schema([
                        Section::make('Status')
                            ->schema([
                                TextEntry::make('registration_status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'registered' => 'success',
                                        'in_progress' => 'warning',
                                        'not_registered' => 'danger',
                                        default => 'gray',
                                    }),
                                TextEntry::make('registration_number'),
                                TextEntry::make('contract_date')->date(),
                                TextEntry::make('contract_expiry_date')->date(),
                            ]),
                        Section::make('Notes')
                            ->schema([TextEntry::make('remarks')->placeholder('None')]),
                    ]),
            ])->columns(4);
    }
}