<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'scheme_code_user',
        'scheme_name',
        'scheme_name_np',
        
        // Sub Schemes
        'no_of_sub_schemes', // Renamed from no_subscheme

        // Collaborator
        'collaborator', 

        // Type & Classification
        'scheme_sector', // Renamed from sector
        'scheme_construction_type',
        'scheme_technology',

        // Timing & Dates
        'started_date',
        'planned_completion_date',
        'actual_completed_date',

        // Status Flags
        'source_registration_status',
        'source_conservation',
        'progress_status',
        'justification_for_delay',
    ];

    protected $casts = [
        'collaborator' => 'array', // JSON to Array
        'source_registration_status' => 'boolean',
        'source_conservation' => 'boolean',
        // 'no_of_sub_schemes' is a string in migration, no boolean cast needed unless you want integer.
        
        'started_date' => 'date',
        'planned_completion_date' => 'date',
        'actual_completed_date' => 'date',
    ];

    // -------------------
    // Booted model events
    // -------------------

    protected static function booted(): void
    {
        static::addGlobalScope(new \App\Models\Scopes\SchemeAccessScope);

        static::creating(function (Scheme $scheme) {
            if (empty($scheme->scheme_code)) {
                $scheme->scheme_code = self::generateSchemeCode($scheme);
            }
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

        // Example: BAG_KTM_2025_SchemeName_1
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
        return $this->hasMany(Beneficiary::class, 'scheme_code', 'scheme_code');
    }

    public function waterPoints()
    {
        return $this->hasMany(WaterPoint::class, 'scheme_code', 'scheme_code');
    }

    public function userCommittee()
    {
        return $this->hasMany(UserCommittee::class, 'scheme_code', 'scheme_code');
    }

    public function publicAudits()
    {
        return $this->hasMany(PublicAudit::class, 'scheme_code', 'scheme_code');
    }

    public function sanitationMetrics()
    {
        return $this->hasMany(SanitationMetric::class, 'scheme_code', 'scheme_code');
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'scheme_code', 'scheme_code');
    }

    public function installmentMonitorings()
    {
        return $this->hasMany(InstallmentMonitoring::class, 'scheme_code', 'scheme_code');
    }

    public function structure()
    {
        return $this->hasOne(Structure::class, 'scheme_code', 'scheme_code');
    }

    public function budgets()
    {
        return $this->hasMany(Budget::class, 'scheme_code', 'scheme_code');
    }

    // --- LOCATION RELATIONSHIPS ---

    public function provinceRelation(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province', 'province_code');
    }

    public function districtRelation(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district', 'district_code');
    }

    public function municipalityRelation(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'mun', 'municipality_code');
    }
}