<?php

namespace App\Filament\Resources\HouseholdSanitations\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class HouseholdSanitationInfolist
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
                TextEntry::make('hh_beneficiaries')
                    ->numeric(),
                TextEntry::make('hh_having_toilets')
                    ->numeric(),
                TextEntry::make('hh_having_chang')
                    ->numeric(),
                TextEntry::make('hh_having_handwash_station')
                    ->numeric(),
                TextEntry::make('hh_having_filter')
                    ->numeric(),
                TextEntry::make('hh_having_waste_disposal_system')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
