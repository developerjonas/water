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
        'province', // add province if not already present
        'district',
        'mun',
        'ward_no',
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

    protected static function booted()
    {
        // This is where we generate scheme_code automatically
        static::creating(function ($scheme) {
            $scheme->scheme_code = self::generateSchemeCode($scheme);
        });
    }

    protected static function generateSchemeCode($scheme)
    {
        $year = now()->year;

        // Count existing schemes with the same name
        $count = self::where('scheme_name', $scheme->scheme_name)->count() + 1;

        return strtoupper("{$scheme->province}_{$scheme->district}_{$year}_{$scheme->scheme_name}_{$count}");
    }

    // Relationships
    public function beneficiaries() { return $this->hasMany(Beneficiary::class); }
    public function waterPoints() { return $this->hasMany(WaterPoint::class); }
    public function ucInfos() { return $this->hasMany(UserCommitteeInfo::class); }
    public function publicAudits() { return $this->hasMany(PublicAudit::class); }
    public function hhSanitations() { return $this->hasMany(HouseholdSanitation::class); }
    public function maintenances() { return $this->hasMany(Maintenance::class); }
    public function donors()
{
    return $this->belongsToMany(Donor::class, 'pivot_donor_scheme'); // specify table name
}
}
