<?php

namespace App\Filament\Clusters\Budget\Resources\Budgets\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;
use Filament\Schemas\Schema;

class BudgetInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->columnSpan(['lg' => 2])
                    ->schema([
                        
                        // --- SECTION 1: IDENTITY ---
                        Section::make('Budget Context')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextEntry::make('scheme.scheme_name')
                                        ->label('Scheme Name')
                                        ->icon('heroicon-m-home-modern')
                                        ->weight(FontWeight::Bold),

                                    TextEntry::make('scheme_code')
                                        ->label('System Code')
                                        ->icon('heroicon-m-hashtag')
                                        ->copyable(),
                                ]),
                                Grid::make(2)->schema([
                                    TextEntry::make('budget_code')
                                        ->label('Budget Reference No.')
                                        ->icon('heroicon-m-document-text')
                                        ->placeholder('N/A'),

                                    TextEntry::make('budget_status')
                                        ->label('Current Status')
                                        ->badge()
                                        ->color(fn (string $state): string => match ($state) {
                                            'draft' => 'gray',
                                            'proposed' => 'info',
                                            'approved' => 'success',
                                            'rejected' => 'danger',
                                            'final' => 'primary',
                                            default => 'gray',
                                        })
                                        ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                                ]),
                            ]),

                        // --- SECTION 2: BREAKDOWN ---
                        Section::make('Financial Breakdown')
                            ->description('Detailed allocation of funds by source.')
                            ->schema([
                                Grid::make(3)->schema([
                                    // Row 1: Helvetas
                                    TextEntry::make('helvetas_estimated_cash')
                                        ->label('Helvetas (Cash)')
                                        ->money('NPR')
                                        ->color('gray'),
                                    
                                    TextEntry::make('helvetas_estimated_kind')
                                        ->label('Helvetas (Kind)')
                                        ->money('NPR')
                                        ->color('gray'),

                                    TextEntry::make('helvetas_estimated_total')
                                        ->label('Helvetas Subtotal')
                                        ->money('NPR')
                                        ->weight(FontWeight::Bold),

                                    // Row 2: Partners
                                    TextEntry::make('palika_estimated')
                                        ->label('Palika Contribution')
                                        ->money('NPR'),

                                    TextEntry::make('community_contribution')
                                        ->label('Community Contribution')
                                        ->money('NPR'),
                                        
                                ]),

                                // Grand Total Box
                                Section::make()
                                    ->schema([
                                        TextEntry::make('total_estimated')
                                            ->label('Grand Total Estimated Budget')
                                            ->money('NPR')
                                            ->weight(FontWeight::Black)
                                            ->color('success')
                                            ->alignCenter(),
                                    ])->compact(),
                            ]),
                    ]),

                Group::make()
                    ->columnSpan(['lg' => 1])
                    ->schema([
                        // --- SECTION 3: NOTES ---
                        Section::make('Remarks')
                            ->schema([
                                TextEntry::make('remarks')
                                    ->markdown()
                                    ->prose()
                                    ->placeholder('No remarks available.'),
                            ]),

                        // --- META ---
                        Section::make('System Info')
                            ->collapsed()
                            ->schema([
                                TextEntry::make('created_at')->dateTime(),
                                TextEntry::make('updated_at')->dateTime(),
                            ]),
                    ]),
            ])
            ->columns(3);
    }
}