<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Added this import
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
        'collaborator' => 'array', // automatically handle array <-> JSON conversion
        'source_registration_status' => 'boolean',
        'source_conservation' => 'boolean',
        'no_subscheme' => 'boolean',
        'agreement_signed_date' => 'date',
        'started_date' => 'date',
        'schedule_end_date' => 'date',
        'planned_completion_date' => 'date',
        'actual_completed_date' => 'date',
        'completion_date' => 'date',
    ];

    // -------------------
    // Booted model events
    // -------------------

    protected static function booted(): void
    {
        static::addGlobalScope(new \App\Models\Scopes\SchemeAccessScope);

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
        return $this->hasMany(Beneficiary::class, 'scheme_code', 'scheme_code');
    }

    public function waterPoints()
    {
        return $this->hasMany(WaterPoint::class);
    }

    public function userCommittee()
    {
        return $this->hasMany(UserCommittee::class, 'scheme_code', 'scheme_code');
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
        return $this->hasOne(Structure::class);
    }

    public function structure()
    {
        return $this->hasOne(Structure::class, 'scheme_code', 'scheme_code');
    }

    public function subsidies()
    {
        return $this->hasMany(Subsidy::class);
    }

    // --- LOCATION RELATIONSHIPS ---

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province', 'province_code');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district', 'district_code');
    }

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class, 'mun', 'municipality_code');
    }

    // -------------------
    // Helpers
    // -------------------

    public static function importRow(array $row): Scheme
    {
        return self::updateOrCreate(
            ['scheme_code' => $row['scheme_code']], // unique identifier
            [
                'province' => $row['province'],
                'district' => $row['district'],
                'mun' => $row['mun'],
                'ward_no' => $row['ward_no'],
                'scheme_name' => $row['scheme_name'],
                'scheme_name_np' => $row['scheme_name_np'] ?? null,
                'collaborator' => $row['collaborator'] ?? null,
                'sector' => $row['sector'] ?? null,
                'scheme_technology' => $row['scheme_technology'] ?? null,
                'scheme_type' => $row['scheme_type'] ?? 'DWS',
                'scheme_construction_type' => $row['scheme_construction_type'] ?? 'New',
                'scheme_start_year' => $row['scheme_start_year'],
                'completion_date' => $row['completion_date'] ?? null,
                'agreement_signed_date' => $row['agreement_signed_date'] ?? null,
                'schedule_end_date' => $row['schedule_end_date'] ?? null,
                'started_date' => $row['started_date'] ?? null,
                'planned_completion_date' => $row['planned_completion_date'] ?? null,
                'actual_completed_date' => $row['actual_completed_date'] ?? null,
                'source_registration_status' => filter_var($row['source_registration_status'] ?? false, FILTER_VALIDATE_BOOLEAN),
                'source_conservation' => filter_var($row['source_conservation'] ?? false, FILTER_VALIDATE_BOOLEAN),
                'no_subscheme' => filter_var($row['no_subscheme'] ?? false, FILTER_VALIDATE_BOOLEAN),
                'progress_status' => $row['progress_status'] ?? null,
                'justification_for_delay' => $row['justification_for_delay'] ?? null,
            ]
        );
    }
}