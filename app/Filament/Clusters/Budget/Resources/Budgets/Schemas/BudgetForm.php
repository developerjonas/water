<?php

namespace App\Filament\Clusters\Budget\Resources\Budgets\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Wizard\Step;
use App\Filament\Components\SchemeSelector;


class BudgetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make()
                    ->schema([
                        // Step 1: Scheme Selection
                        Step::make('Scheme & Formation')->schema(SchemeSelector::make()),

                        // Step 2: Budget & Approvals
                        Step::make('Budget & Approvals')
                            ->schema([
                                Grid::make(3) // 3 columns for alignment: Contribution | Estimated | Actual
                                    ->schema([
                                        // Header Row
                                        Placeholder::make('header_contribution')->content('Contribution'),
                                        Placeholder::make('header_estimated')->content('Estimated'),
                                        Placeholder::make('header_actual')->content('Actual'),

                                        // Helvetas Cash
                                        Placeholder::make('helvetas_cash_label')->content('Helvetas Cash'),
                                        TextInput::make('helvetas_cash_estimated')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),
                                        TextInput::make('helvetas_cash_actual')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),

                                        // Helvetas Kind
                                        Placeholder::make('helvetas_kind_label')->content('Helvetas Kind'),
                                        TextInput::make('helvetas_kind_estimated')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),
                                        TextInput::make('helvetas_kind_actual')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),

                                        // Helvetas Total
                                        Placeholder::make('helvetas_total_label')->content('Helvetas Total'),
                                        TextInput::make('helvetas_total_estimated')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),
                                        TextInput::make('helvetas_total_actual')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),

                                        // Users
                                        Placeholder::make('users_label')->content('Users'),
                                        TextInput::make('users_estimated')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),
                                        TextInput::make('users_actual')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),

                                        // Individual Private Tap
                                        Placeholder::make('private_tap_label')->content('Individual Private Tap'),
                                        TextInput::make('individual_private_tap_estimated')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),
                                        TextInput::make('individual_private_tap_actual')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),

                                        // Palika
                                        Placeholder::make('palika_label')->content('Palika'),
                                        TextInput::make('palika_estimated')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),
                                        TextInput::make('palika_actual')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),

                                        // Total
                                        Placeholder::make('total_label')->content('Total'),
                                        TextInput::make('total_estimated')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),
                                        TextInput::make('total_actual')
                                            ->numeric()
                                            ->default(0)
                                            ->required(),
                                    ]),



                            ]),

                        // Step 3: Remarks
                        Step::make('Remarks')->schema([
                            Textarea::make('remarks')->label('Remarks')->rows(3)->nullable(),
                            Select::make('budget_status')
                                ->label('Status')
                                ->options([
                                    'draft' => 'Draft',
                                    'finalized' => 'Finalized',
                                    'verified' => 'Verified / Ready for Monitoring',
                                ])
                                ->default('draft')
                                ->required(),
                        ]),
                    ])->columnSpanFull(),
            ]);
    }
}
