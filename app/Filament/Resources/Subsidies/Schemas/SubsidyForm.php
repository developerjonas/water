<?php

namespace App\Filament\Resources\Subsidies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
use Filament\Schemas\Schema;
use App\Filament\Components\SchemeSelector;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
class SubsidyForm
{
    public static function configure(Schema $schema): Schema
    {
        $descriptions = [
            'Non-Local Construction Materials',
            'Transportation',
            'Truck',
            'Truck Loading',
            'Truck Off Loading',
            'Tractor',
            'Tractor Loading',
            'Tractor Off Loading',
            'Total Sanitation',
            'Portering Water Part',
            'Local Construction Material',
            'Collection and formation',
            'Purchase and Transport',
            'Portering',
            'Labour Cost',
            'Skilled Labour',
            'Structural Works',
            'Pipeline Works',
            'Unskilled Labour',
            'Structural Works',
            'Pipeline Works',
            'Other Cost',
            'Store Rent',
            'Roadhead',
            'Project Site',
            'Project Management Cost',
            'Contingency',
            'Total Sanitation Incentive Cost',
        ];

        $defaultRows = array_map(fn($desc) => [
            'item_name' => $desc,
            'total_estimated' => 0,
            'advance_1' => 0,
            'advance_2' => 0,
            'advance_3' => 0,
            'settlement_1' => 0,
            'settlement_2' => 0,
            'settlement_3' => 0,
        ], $descriptions);

        return $schema
            ->components([
                Wizard::make()
                    ->schema([
                        Step::make('Scheme & Formation')
                            ->schema(SchemeSelector::make()),


                                    Step::make('Budget & Approvals')
                                        ->schema([
                                            TableRepeater::make('budget_rows')
                                                ->label('Budget Table')
                                                ->columns(3)
                                                ->default([
                                                    ['title' => 'Helvetas Cash', 'estimated' => 876982.57, 'actual' => 719125.71],
                                                    ['title' => 'Helvetas Kind', 'estimated' => 2770026.88, 'actual' => 2271422.05],
                                                    ['title' => 'Helvetas Total', 'estimated' => 3647009.46, 'actual' => 2990547.76],
                                                    ['title' => 'Users', 'estimated' => 1002297.41, 'actual' => 821883.88],
                                                    ['title' => 'Individual Private Tap', 'estimated' => 515939.98, 'actual' => 423070.78],
                                                    ['title' => 'Palika', 'estimated' => 1689661.83, 'actual' => 1385522.70],
                                                    ['title' => 'Total', 'estimated' => 6854908.68, 'actual' => 5621025.12],
                                                ])
                                                ->schema([
                                                    TextInput::make('title')
                                                        ->label('Contribution')
                                                        ->disabled()
                                                        ->dehydrateStateUsing(fn($state) => $state),
                                                    TextInput::make('estimated')
                                                        ->label('Estimated')
                                                        ->numeric()
                                                        ->required(),
                                                    TextInput::make('actual')
                                                        ->label('Actual')
                                                        ->numeric()
                                                        ->required(),
                                                ])
                                                ->columns(1)
                                                ->disableItemCreation()
                                                ->disableItemDeletion()
                                                ->disableItemMovement()
                                                ->collapsible()
                                                ->dehydrateStateUsing(fn($state) => $state),
                                        ]),



                        Step::make('Subsidy Items')
                            ->schema([
                                TableRepeater::make('items')
                                    ->relationship('items') // link to SubsidyItem
                                    ->label('Subsidy Items')
                                    ->columns(8)
                                    ->schema([
                                        TextInput::make('item_name')
                                            ->label('Description')
                                            ->readonly()
                                            ->dehydrateStateUsing(fn($state) => $state),
                                        TextInput::make('original_estimated')->numeric()->default(0),
                                        TextInput::make('additional_estimated')->numeric()->default(0),
                                        TextInput::make('total_estimated')->numeric()->default(0),
                                        TextInput::make('advance_1')->numeric()->default(0),
                                        TextInput::make('advance_2')->numeric()->default(0),
                                        TextInput::make('advance_3')->numeric()->default(0),
                                        TextInput::make('settlement_1')->numeric()->default(0),
                                        TextInput::make('settlement_2')->numeric()->default(0),
                                        TextInput::make('settlement_3')->numeric()->default(0),
                                    ])
                                    ->default($defaultRows)
                                    ->columns(1)
                                    ->collapsible()
                                    ->disableItemDeletion()
                                    ->disableItemMovement()
                                    ->disableItemCreation()
                                    ->dehydrateStateUsing(fn($state) => $state),
                            ]),

                        Step::make('Approvals')
                            ->schema([
                                Grid::make(1)->schema([
                                    // Helvetas Cash & Kind


                                    // Approval Toggles
                                    Toggle::make('mb_submitted_to_municipality')
                                        ->label('MB Submitted to Municipality')
                                        ->required(),
                                    Toggle::make('municipality_contribution_transferred')
                                        ->label('Municipality Contribution Transferred')
                                        ->required(),
                                    Toggle::make('public_hearing_done')
                                        ->label('Public Hearing Done')
                                        ->required(),
                                    Toggle::make('public_review_done')
                                        ->label('Public Review Done')
                                        ->required(),
                                    Toggle::make('final_public_audit_done')
                                        ->label('Final Public Audit Done')
                                        ->required(),

                                ]),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }
}
