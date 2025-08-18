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
                TextInput::make('scheme_code')
                    ->required(),
                TextInput::make('helvetas_estimated_cash')
                    ->numeric(),
                TextInput::make('helvetas_estimated_kd')
                    ->numeric(),
                TextInput::make('rms_estimated')
                    ->numeric(),
                TextInput::make('users_estimated')
                    ->numeric(),
                TextInput::make('others_estimated')
                    ->numeric(),
                TextInput::make('estimated_total')
                    ->numeric(),
                TextInput::make('helvetas_actual_cash')
                    ->numeric(),
                TextInput::make('helvetas_actual_kd')
                    ->numeric(),
                TextInput::make('rms_actual')
                    ->numeric(),
                TextInput::make('users_actual')
                    ->numeric(),
                TextInput::make('others_actual')
                    ->numeric(),
                TextInput::make('actual_total')
                    ->numeric(),
            ]);
    }
}
