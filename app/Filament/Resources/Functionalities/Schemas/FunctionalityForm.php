<?php

namespace App\Filament\Resources\Functionalities\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class FunctionalityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('province'),
                TextInput::make('district'),
                TextInput::make('municipality'),
                TextInput::make('ward_no'),
                TextInput::make('scheme_year'),
                TextInput::make('scheme_completion_date'),
                TextInput::make('female_members'),
                TextInput::make('male_members'),
                TextInput::make('total_members'),
                TextInput::make('janjati_members'),
                TextInput::make('dalit_members'),
                TextInput::make('other_members'),
                TextInput::make('uc_meeting_status'),
                TextInput::make('uc_latest_meeting_date'),
                TextInput::make('vmw_name'),
                TextInput::make('trained_vmw'),
                TextInput::make('vmw_status'),
                TextInput::make('vmw_salary'),
                TextInput::make('maintenance_fund_per_house'),
                TextInput::make('expected_monthly_collection'),
                TextInput::make('total_fund_deposited'),
                TextInput::make('fund_location'),
                TextInput::make('total_expenditure'),
                TextInput::make('record_status'),
                TextInput::make('total_households'),
                TextInput::make('total_taps'),
                TextInput::make('functional_taps'),
                TextInput::make('non_functional_taps'),
                TextInput::make('reason_non_functional'),
                TextInput::make('scheme_registration_status'),
                TextInput::make('notice_board_status'),
                TextInput::make('rvt_status'),
                TextInput::make('resource_conservation_practice'),
                TextInput::make('households_with_filter'),
                TextInput::make('households_with_garbage_dump'),
                TextInput::make('households_with_drying_rack'),
                TextInput::make('rvt_photo'),
                TextInput::make('monitoring_photo'),
                TextInput::make('solar_lift_photo'),
                TextInput::make('tap_photo'),
                TextInput::make('garbage_dryer_photo'),
            ]);
    }
}
