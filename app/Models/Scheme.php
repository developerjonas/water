<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Correct imports based on your existing models
use App\Models\Beneficiary;
use App\Models\WaterPoint;
use App\Models\UserCommittee;
use App\Models\PublicAudit;
use App\Models\SanitationMetric;
use App\Models\Maintenance;
use App\Models\InstallmentMonitoring;
use App\Models\StructureInfo;
use App\Models\Structure;
use App\Models\Donor;

class Scheme extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        // Location / Address
        'province',
        'district',
        'mun',
        'ward_no',

        // Identification
        'scheme_code',
        'scheme_name',
        'scheme_name_np',
        'collaborator', // New column for collaborator/partner organization

        // Type & Classification
        'sector',
        'scheme_technology',
        'scheme_type',
        'scheme_construction_type',

        // Timing & Dates
        'scheme_start_year',
        'completion_date',
        'agreement_signed_date',
        'schedule_end_date',
        'started_date',
        'planned_completion_date',
        'actual_completed_date',

        // Status Flags
        'source_registration_status',
        'source_conservation',
        'no_subscheme',
        'progress_status',
        'justification_for_delay',
    ];

    protected $casts = [
        'collaborator' => 'array', // <-- this will automatically handle array <-> JSON conversion
        'source_registration_status' => 'boolean',
        'source_conservation' => 'boolean',
        'no_subscheme' => 'boolean',
    ];


    // -------------------
    // Booted model events
    // -------------------

    protected static function booted(): void
    {
        static::creating(function (Scheme $scheme) {
            $scheme->scheme_code = self::generateSchemeCode($scheme);
        });

        static::saved(function (Scheme $scheme) {
            if (isset($scheme->collaborator) && is_array($scheme->collaborator)) {
                // Sync the donor IDs with the pivot table
                $scheme->donors()->sync($scheme->collaborator);
            }
        });
    }



    /**
     * Generates a unique scheme code based on location, year, and scheme name.
     */
    protected static function generateSchemeCode(Scheme $scheme): string
    {
        $year = now()->year;
        $count = self::where('scheme_name', $scheme->scheme_name)->count() + 1;
        $schemeNameFormatted = str_replace(' ', '_', $scheme->scheme_name);

        return strtoupper("{$scheme->province}_{$scheme->district}_{$year}_{$schemeNameFormatted}_{$count}");
    }

    // -------------------
    // Relationships
    // -------------------

    public function donors()
    {
        return $this->belongsToMany(Donor::class, 'pivot_donor_scheme');
    }

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }

    public function waterPoints()
    {
        return $this->hasMany(WaterPoint::class);
    }

    public function userCommittees()
    {
        return $this->hasMany(UserCommittee::class);
    }

    public function publicAudits()
    {
        return $this->hasMany(PublicAudit::class);
    }

    public function sanitationMetrics()
    {
        return $this->hasMany(SanitationMetric::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function installmentMonitorings()
    {
        return $this->hasMany(InstallmentMonitoring::class);
    }

    public function structureInfo()
    {
        return $this->hasOne(StructureInfo::class);
    }

    public function structure()
    {
        return $this->hasOne(Structure::class);
    }

    public function subsidies()
    {
        return $this->hasMany(Subsidy::class);
    }

}
