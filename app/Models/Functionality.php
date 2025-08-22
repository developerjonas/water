<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Functionality extends Model
{
    use HasFactory;

    protected $table = 'functionality';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        // General Info
        'province',
        'district',
        'municipality',
        'ward_no',
        'scheme_year',
        'scheme_completion_date',

        // UC Info
        'female_members',
        'male_members',
        'total_members',
        'janjati_members',
        'dalit_members',
        'other_members',
        'uc_meeting_status',
        'uc_latest_meeting_date',

        // VMW Info
        'vmw_name',
        'trained_vmw',
        'vmw_status',
        'vmw_salary',

        // Financial Info
        'maintenance_fund_per_house',
        'expected_monthly_collection',
        'total_fund_deposited',
        'fund_location',
        'total_expenditure',
        'record_status',

        // Scheme Functionality
        'total_households',
        'total_taps',
        'functional_taps',
        'non_functional_taps',
        'reason_non_functional',
        'scheme_registration_status',
        'notice_board_status',

        // RVT & Conservation
        'rvt_status',
        'resource_conservation_practice',
        'households_with_filter',
        'households_with_garbage_dump',
        'households_with_drying_rack',

        // Media Uploads
        'rvt_photo',
        'monitoring_photo',
        'solar_lift_photo',
        'tap_photo',
        'garbage_dryer_photo',
    ];
}
