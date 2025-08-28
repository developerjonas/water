<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUpSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
        'follow_up_type','enumerator_name','follow_up_date','key_respondent_name','key_respondent_position','key_respondent_contact','wusc_official_name',
        'scheme_code',
        'total_households','total_taps','functional_taps','non_functional_taps_closure','non_functional_taps_no_water','reasons_non_functionality','is_mus','households_with_kitchen_gardens','avg_kitchen_garden_size',
        'is_wusc','total_wusc_officials','female_officials','dalit_officials','janajati_officials','wusc_chairperson_name','wusc_chairperson_contact','wusc_vice_chairperson_name','wusc_vice_chairperson_contact','wusc_secretary_name','wusc_secretary_contact','wusc_treasurer_name','wusc_treasurer_contact',
        'is_caretaker','caretaker_name','caretaker_contact','caretaker_regular','caretaker_trained','caretaker_paid','caretaker_honorarium',
        'is_wusc_registered','registration_number','ag_assembly_regular','last_general_assembly_date','meetings_regular','meeting_frequency','meetings_last_year','wusc_reformed','record_minutes','record_income_expense','has_om_plan','fund_collection_regular','monthly_tariff','total_om_fund',
        'status_intake','status_pipeline','status_rvt','status_tap_stands','status_other_structures','photo_1','photo_2',
        'major_problems','enumerator_suggestions','improvements_done',
        'latitude','longitude'
    ];

    protected $casts = [
        'follow_up_date' => 'date',
        'is_mus' => 'boolean',
        'is_wusc' => 'boolean',
        'is_caretaker' => 'boolean',
        'caretaker_regular' => 'boolean',
        'caretaker_trained' => 'boolean',
        'caretaker_paid' => 'boolean',
        'is_wusc_registered' => 'boolean',
        'ag_assembly_regular' => 'boolean',
        'meetings_regular' => 'boolean',
        'wusc_reformed' => 'boolean',
        'has_om_plan' => 'boolean',
        'fund_collection_regular' => 'boolean',
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }
}
