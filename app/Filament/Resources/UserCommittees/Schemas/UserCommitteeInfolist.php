<?php

namespace App\Filament\Resources\UserCommittees\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserCommitteeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('scheme_code'),
                TextEntry::make('date_of_formation')
                    ->date(),
                TextEntry::make('user_committee_bank_account_name'),
                TextEntry::make('chair_name'),
                TextEntry::make('chair_contact'),
                TextEntry::make('vice_chair_name'),
                TextEntry::make('vice_chair_contact'),
                TextEntry::make('secretary_name'),
                TextEntry::make('secretary_contact'),
                TextEntry::make('deputy_secretary_name'),
                TextEntry::make('deputy_secretary_contact'),
                TextEntry::make('treasurer_name'),
                TextEntry::make('treasurer_contact'),
                TextEntry::make('dalit_female_key')
                    ->numeric(),
                TextEntry::make('dalit_male_key')
                    ->numeric(),
                TextEntry::make('dalit_female_member')
                    ->numeric(),
                TextEntry::make('dalit_male_member')
                    ->numeric(),
                TextEntry::make('janjati_female_key')
                    ->numeric(),
                TextEntry::make('janjati_male_key')
                    ->numeric(),
                TextEntry::make('janjati_female_member')
                    ->numeric(),
                TextEntry::make('janjati_male_member')
                    ->numeric(),
                TextEntry::make('others_female_key')
                    ->numeric(),
                TextEntry::make('others_male_key')
                    ->numeric(),
                TextEntry::make('others_female_member')
                    ->numeric(),
                TextEntry::make('others_male_member')
                    ->numeric(),
                TextEntry::make('wusc_registration_status'),
                TextEntry::make('registration_number'),
                TextEntry::make('contract_date')
                    ->date(),
                TextEntry::make('contract_expiry_date')
                    ->date(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
