<?php

namespace App\Filament\Clusters\BudgetStuffs\Resources\SchemeBudgets\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use App\Models\Scheme;
use Filament\Schemas\Components\Wizard;


class SchemeBudgetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Wizard\Step::make('Scheme Selection')
                        ->schema([
                            Select::make('scheme_code')
                                ->label('Scheme')
                                ->options(Scheme::all()->pluck('scheme_name', 'id'))
                                ->required(),
                            TextInput::make('sub_schemes')
                                ->label('Sub-schemes (comma-separated)')
                                ->placeholder('DWS1,DWS2,...')
                        ]),

                    Wizard\Step::make('Estimated Data')
                        ->schema([
                            TextInput::make('estimated_amount')->numeric(),
                            TextInput::make('estimated_helvetas_cash')->numeric(),
                            TextInput::make('estimated_helvetas_kd')->numeric(),
                            TextInput::make('estimated_municipality')->numeric(),
                            TextInput::make('estimated_users')->numeric(),
                            TextInput::make('estimated_others')->numeric(),
                        ]),

                    Wizard\Step::make('Actual Data')
                        ->schema([
                            TextInput::make('actual_amount')->numeric(),
                            TextInput::make('actual_helvetas_cash')->numeric(),
                            TextInput::make('actual_helvetas_kd')->numeric(),
                            TextInput::make('actual_municipality')->numeric(),
                            TextInput::make('actual_users')->numeric(),
                            TextInput::make('actual_others')->numeric(),
                        ]),
                ]),
            ]);
    }
}
