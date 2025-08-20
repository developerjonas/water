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
     * Keep aligned with the migration columns for consistency.
     */
    protected $fillable = [
        // -------------------
        // Location / Address
        // -------------------
        'province',
        'district',
        'mun',
        'ward_no',

        // -------------------
        // Identification
        // -------------------
        'scheme_code',
        'scheme_name',
        'scheme_name_np',

        // -------------------
        // Type & Classification
        // -------------------
        'sector',
        'scheme_technology',
        'scheme_type',
        'scheme_construction_type',

        // -------------------
        // Timing & Dates
        // -------------------
        'scheme_start_year',
        'completion_date',
        'agreement_signed_date',
        'schedule_end_date',
        'started_date',
        'planned_completion_date',
        'actual_completed_date',

        // -------------------
        // Status Flags
        // -------------------
        'source_registration_status',
        'source_conservation',
        'no_subscheme',
        'progress_status',
        'justification_for_delay',
    ];

    /**
     * Automatically generate a unique scheme_code on creation.
     */
    protected static function booted()
    {
        static::creating(function ($scheme) {
            $scheme->scheme_code = self::generateSchemeCode($scheme);
        });
    }

    /**
     * Generates a unique scheme code based on location, year, and scheme name.
     */
    protected static function generateSchemeCode($scheme)
    {
        $year = now()->year;

        // Count existing schemes with the same name for uniqueness
        $count = self::where('scheme_name', $scheme->scheme_name)->count() + 1;

        // Replace spaces with underscores in scheme name
        $schemeName = str_replace(' ', '_', $scheme->scheme_name);

        return strtoupper("{$scheme->province}_{$scheme->district}_{$year}_{$schemeName}_{$count}");
    }

    // -------------------
    // Relationships
    // -------------------

    /**
     * Many-to-many relationship with donors via pivot table.
     */
    public function donors()
    {
        return $this->belongsToMany(Donor::class, 'pivot_donor_scheme');
    }

    /**
     * One-to-many relationships
     */
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

    public function installmentMonitorings()
    {
        return $this->hasMany(InstallmentMonitoring::class);
    }

    /**
     * One-to-one relationship for structure info
     */
    public function structureInfo()
    {
        return $this->hasOne(StructureInfo::class);
    }
}
