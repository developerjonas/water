<?php

namespace App\Filament\Resources\Subsidies\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
use Filament\Schemas\Schema;
use App\Models\Scheme;

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
                Grid::make(1)->schema([
                    Select::make('scheme_code')
                        ->label('Scheme')
                        ->required()
                        ->options(Scheme::all()->pluck('scheme_name', 'scheme_code')->toArray())
                        ->searchable()->unique(table: 'subsidies', column: 'scheme_code'),
                    TextInput::make('helvetas_cash')->label('Helvetas Cash')->numeric()->required()->default(0),
                    TextInput::make('helvetas_kind')->label('Helvetas Kind')->numeric()->required()->default(0),
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
                TableRepeater::make('items')
                    ->relationship('items') // link to SubsidyItem
                    ->label('Subsidy Items')
                    ->columns(8)
                    ->schema([
                        TextInput::make('item_name')->label('Description')->readonly()
                            ->dehydrateStateUsing(fn($state) => $state) // always include in submission
                        ,
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
                    ->dehydrateStateUsing(fn($state) => $state) // just pass everything, no payments
            ]);
    }
}
