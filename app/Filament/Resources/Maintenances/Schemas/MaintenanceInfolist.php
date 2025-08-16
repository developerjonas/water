<?php

namespace App\Filament\Resources\Maintenances\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MaintenanceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_id')
                    ->numeric(),
                TextEntry::make('district'),
                TextEntry::make('palika'),
                TextEntry::make('donor'),
                TextEntry::make('scheme_start_year'),
                TextEntry::make('scheme_name'),
                TextEntry::make('bank_name'),
                TextEntry::make('account_no'),
                TextEntry::make('account_name'),
                TextEntry::make('fund_collected_last_year')
                    ->numeric(),
                TextEntry::make('fund_collection_per_hh')
                    ->numeric(),
                TextEntry::make('total_fund_collection_this_year')
                    ->numeric(),
                TextEntry::make('total_fund_till_date')
                    ->numeric(),
                TextEntry::make('expenditure_till_date')
                    ->numeric(),
                TextEntry::make('hh_beneficiaries')
                    ->numeric(),
                TextEntry::make('total_taps')
                    ->numeric(),
                TextEntry::make('maintenance_fund_per_tap')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
