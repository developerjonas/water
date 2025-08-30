<?php

namespace App\Filament\Clusters\Budget\Resources\Subsidies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;
use App\Filament\Components\SchemeSelector;


class SubsidyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make()
                    ->schema([
                        Step::make('Scheme & Formation')
                            ->schema(SchemeSelector::make()),

                        Step::make('Subsidy Items')
                            ->schema([
                                Repeater::make('subsidies')
                                    ->label('Subsidy Items')
                                    ->schema([
                                        Grid::make(6)->schema([
                                            TextInput::make('section')
                                                ->label('Section')
                                                ->disabled(),

                                            TextInput::make('sub_item')
                                                ->label('Sub-item')
                                                ->disabled(),

                                            TextInput::make('description')
                                                ->label('Particulars')
                                                ->disabled(),

                                            TextInput::make('original_estimated')
                                                ->label('Original Estimated')
                                                ->numeric()
                                                ->required(),

                                            TextInput::make('additional_estimated')
                                                ->label('Additional Estimated')
                                                ->numeric()
                                                ->nullable(),

                                            TextInput::make('total_estimated')
                                                ->label('Total Estimated')
                                                ->numeric()
                                                ->disabled()
                                                ->dehydrateStateUsing(fn($get, $state) => $state + ($get('additional_estimated') ?? 0)),
                                        ]),

                                        Grid::make(6)->schema([
                                            TextInput::make('advance_1')->label('A1')->numeric()->default(0),
                                            TextInput::make('advance_2')->label('A2')->numeric()->default(0),
                                            TextInput::make('advance_3')->label('A3')->numeric()->default(0),
                                            TextInput::make('adv_total')
                                                ->label('Advance Total')
                                                ->numeric()
                                                ->disabled()
                                                ->dehydrateStateUsing(fn($get) => $get('advance_1') + $get('advance_2') + $get('advance_3')),

                                            TextInput::make('settlement_1')->label('S1')->numeric()->default(0),
                                            TextInput::make('settlement_2')->label('S2')->numeric()->default(0),
                                            TextInput::make('settlement_3')->label('S3')->numeric()->default(0),
                                            TextInput::make('settle_total')
                                                ->label('Settlement Total')
                                                ->numeric()
                                                ->disabled()
                                                ->dehydrateStateUsing(fn($get) => $get('settlement_1') + $get('settlement_2') + $get('settlement_3')),

                                            TextInput::make('remaining')
                                                ->label('Remaining')
                                                ->numeric()
                                                ->disabled()
                                                ->dehydrateStateUsing(fn($get) => $get('total_estimated') - $get('settle_total')),
                                        ]),
                                    ])
                                    ->default(fn() => [
                                        ['section' => 'A', 'sub_item' => '', 'description' => 'Non-Local Construction Materials', 'original_estimated' => 2821314.51],
                                        ['section' => 'A', 'sub_item' => 'A.1', 'description' => 'Procurement', 'original_estimated' => 2550705.85],
                                        ['section' => 'A', 'sub_item' => 'A.2', 'description' => 'Transportation', 'original_estimated' => 240373.96],
                                        // ... continue for all rows A–H
                                        ['section' => 'H', 'sub_item' => '', 'description' => 'WASH in School software activities', 'original_estimated' => 0],
                                    ])
                                    ->disableItemCreation()
                                    ->disableItemDeletion()
                                    ->collapsible(false),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
