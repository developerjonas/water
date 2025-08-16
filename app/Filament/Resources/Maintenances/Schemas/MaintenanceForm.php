<?php

namespace App\Filament\Resources\Maintenances\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MaintenanceForm
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
                TextInput::make('donor'),
                TextInput::make('scheme_start_year'),
                TextInput::make('scheme_name'),
                TextInput::make('bank_name'),
                TextInput::make('account_no'),
                TextInput::make('account_name'),
                TextInput::make('fund_collected_last_year')
                    ->numeric(),
                TextInput::make('fund_collection_per_hh')
                    ->numeric(),
                TextInput::make('total_fund_collection_this_year')
                    ->numeric(),
                TextInput::make('total_fund_till_date')
                    ->numeric(),
                TextInput::make('expenditure_till_date')
                    ->numeric(),
                TextInput::make('hh_beneficiaries')
                    ->numeric(),
                TextInput::make('total_taps')
                    ->numeric(),
                TextInput::make('maintenance_fund_per_tap')
                    ->numeric(),
            ]);
    }
}
