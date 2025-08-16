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
                TextEntry::make('district'),
                TextEntry::make('palika'),
                TextEntry::make('scheme_id')
                    ->numeric(),
                TextEntry::make('sector'),
                TextEntry::make('sub_schemes')
                    ->numeric(),
                TextEntry::make('total_female')
                    ->numeric(),
                TextEntry::make('total_male')
                    ->numeric(),
                TextEntry::make('total_beneficiaries')
                    ->numeric(),
                TextEntry::make('schools')
                    ->numeric(),
                TextEntry::make('taps_provided')
                    ->numeric(),
                TextEntry::make('boys_students')
                    ->numeric(),
                TextEntry::make('girls_students')
                    ->numeric(),
                TextEntry::make('teachers')
                    ->numeric(),
                TextEntry::make('total_population')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
