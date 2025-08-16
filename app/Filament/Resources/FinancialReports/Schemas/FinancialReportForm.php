<?php

namespace App\Filament\Resources\FinancialReports\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FinancialReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('scheme_id')
                    ->required()
                    ->numeric(),
                TextInput::make('district'),
                TextInput::make('palika'),
                TextInput::make('sector'),
                TextInput::make('sub_schemes')
                    ->numeric(),
                TextInput::make('estimated_total')
                    ->numeric(),
                TextInput::make('helvetas_actual')
                    ->numeric(),
                TextInput::make('rms_actual')
                    ->numeric(),
                TextInput::make('users_actual')
                    ->numeric(),
                TextInput::make('others_actual')
                    ->numeric(),
                TextInput::make('actual_expenditure_total')
                    ->numeric(),
            ]);
    }
}
