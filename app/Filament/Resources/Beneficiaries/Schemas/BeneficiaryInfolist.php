<?php

namespace App\Filament\Resources\Beneficiaries\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BeneficiaryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_code'),
                TextEntry::make('dalit_hh_poor')
                    ->numeric(),
                TextEntry::make('dalit_hh_nonpoor')
                    ->numeric(),
                TextEntry::make('aj_hh_poor')
                    ->numeric(),
                TextEntry::make('aj_hh_nonpoor')
                    ->numeric(),
                TextEntry::make('other_hh_poor')
                    ->numeric(),
                TextEntry::make('other_hh_nonpoor')
                    ->numeric(),
                TextEntry::make('dalit_female')
                    ->numeric(),
                TextEntry::make('dalit_male')
                    ->numeric(),
                TextEntry::make('aj_female')
                    ->numeric(),
                TextEntry::make('aj_male')
                    ->numeric(),
                TextEntry::make('others_female')
                    ->numeric(),
                TextEntry::make('others_male')
                    ->numeric(),
                TextEntry::make('base_population')
                    ->numeric(),
                TextEntry::make('boys_student')
                    ->numeric(),
                TextEntry::make('girls_student')
                    ->numeric(),
                TextEntry::make('teachers_staff')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
