<?php

namespace App\Filament\Clusters\Budget\Resources\Budgets\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use App\Filament\Components\SchemeSelector;

class BudgetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([

                        // --- SECTION 1: CONTEXT ---
                        Section::make('Scheme')->columns(3)
                            ->schema([
                                // The Scheme Selector
                                ...SchemeSelector::make(),

                            ]),

                        Section::make('Scheme')
                            ->schema([

                                Grid::make(2)->schema([
                                    TextInput::make('budget_code')
                                        ->label('Budget Code / Ref No.')
                                        ->placeholder('e.g. BUD-2025-001'),

                                    Select::make('budget_status')
                                        ->label('Status')
                                        ->options([
                                            'draft' => 'Draft',
                                            'proposed' => 'Proposed',
                                            'approved' => 'Approved',
                                            'rejected' => 'Rejected',
                                            'final' => 'Final',
                                        ])
                                        ->default('draft')
                                        ->required()
                                        ->native(false), // Makes it look like a modern dropdown instead of browser default
                                ]),
                            ]),

                        // --- SECTION 2: HELVETAS CONTRIBUTION ---
                        Section::make('Helvetas Contribution')
                            ->description('Breakdown of Cash and Kind support.')
                            ->schema([
                                Grid::make(3)->schema([
                                    TextInput::make('helvetas_estimated_cash')
                                        ->label('Cash')
                                        ->numeric()
                                        ->prefix('NPR')
                                        ->default(0)
                                        ->live(onBlur: true) // Recalculate when user leaves field
                                        ->afterStateUpdated(fn(Set $set, Get $get) => self::updateTotals($set, $get)),

                                    TextInput::make('helvetas_estimated_kind')
                                        ->label('Kind (Materials)')
                                        ->numeric()
                                        ->prefix('NPR')
                                        ->default(0)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn(Set $set, Get $get) => self::updateTotals($set, $get)),

                                    TextInput::make('helvetas_estimated_total')
                                        ->label('Helvetas Subtotal')
                                        ->numeric()
                                        ->prefix('NPR')
                                        ->readOnly() // Auto-calculated
                                        ->extraInputAttributes(['class' => 'bg-gray-50 font-bold']),
                                ]),
                            ]),

                        // --- SECTION 3: OTHER CONTRIBUTIONS ---
                        Section::make('Partner Contributions')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('palika_estimated')
                                        ->label('Palika (Municipality)')
                                        ->numeric()
                                        ->prefix('NPR')
                                        ->default(0)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn(Set $set, Get $get) => self::updateTotals($set, $get)),

                                    TextInput::make('community_contribution')
                                        ->label('Community (Cash/Labor)')
                                        ->numeric()
                                        ->prefix('NPR')
                                        ->default(0)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn(Set $set, Get $get) => self::updateTotals($set, $get)),
                                ]),
                            ]),

                        // --- SECTION 4: GRAND TOTAL ---
                        Section::make()
                            ->schema([
                                TextInput::make('total_estimated')
                                    ->label('Grand Total Estimated Budget')
                                    ->numeric()
                                    ->prefix('NPR')
                                    ->readOnly()
                                    ->extraInputAttributes(['class' => 'text-xl font-black text-green-600']),
                            ]),

                        // --- SECTION 5: NOTES ---
                        Section::make('Additional Notes')
                            ->collapsed()
                            ->schema([
                                Textarea::make('remarks')
                                    ->rows(2)
                                    ->columnSpanFull(),
                            ]),

                    ])->columnSpanFull(),
            ]);
    }

    /**
     * Helper to perform live budget calculations
     */
    protected static function updateTotals(Set $set, Get $get): void
    {
        // 1. Calculate Helvetas Subtotal
        $cash = (float) $get('helvetas_estimated_cash');
        $kind = (float) $get('helvetas_estimated_kind');
        $helvetasTotal = $cash + $kind;

        $set('helvetas_estimated_total', $helvetasTotal);

        // 2. Calculate Grand Total
        $palika = (float) $get('palika_estimated');
        $community = (float) $get('community_contribution');

        $grandTotal = $helvetasTotal + $palika + $community;

        $set('total_estimated', $grandTotal);
    }
}