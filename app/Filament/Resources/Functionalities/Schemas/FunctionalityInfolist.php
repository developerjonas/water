<?php

namespace App\Filament\Resources\Functionalities\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FunctionalityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('province'),
                TextEntry::make('district'),
                TextEntry::make('municipality'),
                TextEntry::make('ward_no'),
                TextEntry::make('scheme_year'),
                TextEntry::make('scheme_completion_date'),
                TextEntry::make('female_members'),
                TextEntry::make('male_members'),
                TextEntry::make('total_members'),
                TextEntry::make('janjati_members'),
                TextEntry::make('dalit_members'),
                TextEntry::make('other_members'),
                TextEntry::make('uc_meeting_status'),
                TextEntry::make('uc_latest_meeting_date'),
                TextEntry::make('vmw_name'),
                TextEntry::make('trained_vmw'),
                TextEntry::make('vmw_status'),
                TextEntry::make('vmw_salary'),
                TextEntry::make('maintenance_fund_per_house'),
                TextEntry::make('expected_monthly_collection'),
                TextEntry::make('total_fund_deposited'),
                TextEntry::make('fund_location'),
                TextEntry::make('total_expenditure'),
                TextEntry::make('record_status'),
                TextEntry::make('total_households'),
                TextEntry::make('total_taps'),
                TextEntry::make('functional_taps'),
                TextEntry::make('non_functional_taps'),
                TextEntry::make('reason_non_functional'),
                TextEntry::make('scheme_registration_status'),
                TextEntry::make('notice_board_status'),
                TextEntry::make('rvt_status'),
                TextEntry::make('resource_conservation_practice'),
                TextEntry::make('households_with_filter'),
                TextEntry::make('households_with_garbage_dump'),
                TextEntry::make('households_with_drying_rack'),
                TextEntry::make('rvt_photo'),
                TextEntry::make('monitoring_photo'),
                TextEntry::make('solar_lift_photo'),
                TextEntry::make('tap_photo'),
                TextEntry::make('garbage_dryer_photo'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
