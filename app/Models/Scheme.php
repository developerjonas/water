<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scheme extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'district',
        'mun',
        'ward_no',
        'donor',
        'scheme_code',
        'scheme_name',
        'sector',
        'scheme_technology',
        'scheme_type',
        'scheme_start_year',
        'source_registration_status',
        'no_subscheme',
        'completed_year',
        'completion_date',
        'source_conservation',
        'agreement_signed_date',
        'schedule_end_date',
        'started_date',
        'planned_completion_date',
        'actual_completed_date',
        'progress_status',
        'justification_for_delay',
    ];

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }

    public function waterPoints()
    {
        return $this->hasMany(WaterPoint::class);
    }
    public function ucInfos()
    {
        return $this->hasMany(UserCommitteeInfo::class);
    }

    public function publicAudits()
    {
        return $this->hasMany(PublicAudit::class);
    }

    public function hhSanitations()
    {
        return $this->hasMany(HouseholdSanitation::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }


}
