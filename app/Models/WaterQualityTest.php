<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WaterQualityTest extends Model
{
    use HasFactory;

    protected $table = 'water_quality_tests';

    protected $fillable = [
        'scheme_code',
        'water_point_id',
        'tested_point_name', // Normalized name from CSV
        'test_date',
        'ecoli',
        'coliform',
        'ph',
        'frc',
        'turbidity',
        'remarks',
    ];

    protected $casts = [
        'test_date' => 'date',
        'ecoli' => 'integer',
        'coliform' => 'integer',
        'ph' => 'decimal:2',
        'frc' => 'decimal:2',
        'turbidity' => 'decimal:2',
    ];

    /**
     * Relation: Belongs to a Scheme
     */
    public function scheme(): BelongsTo
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }

    /**
     * Relation: Belongs to a Water Point (Optional)
     */
    public function waterPoint(): BelongsTo
    {
        return $this->belongsTo(WaterPoint::class);
    }

    // =========================================================================
    // RISK ANALYSIS ATTRIBUTES (WHO / NDWQS Standards)
    // =========================================================================

    /**
     * Compute E.coli Risk Category
     * WHO/NDWQS Standard: 0/100ml is Safe.
     */
    public function getEcoliRiskAttribute(): ?string
    {
        if (is_null($this->ecoli)) return 'Not Tested';

        return match (true) {
            $this->ecoli == 0 => 'Safe (Zero Risk)',
            $this->ecoli <= 10 => 'Low Risk',
            $this->ecoli <= 100 => 'Intermediate Risk',
            default => 'High Risk',
        };
    }

    /**
     * Get Filament Color for E.coli
     */
    public function getEcoliColorAttribute(): string
    {
        if (is_null($this->ecoli)) return 'gray';

        return match (true) {
            $this->ecoli == 0 => 'success', // Green
            $this->ecoli <= 10 => 'info',    // Blue
            $this->ecoli <= 100 => 'warning', // Yellow/Orange
            default => 'danger',              // Red
        };
    }

    /**
     * Compute Coliform Risk Category
     */
    public function getColiformRiskAttribute(): ?string
    {
        if (is_null($this->coliform)) return 'Not Tested';

        return match (true) {
            $this->coliform == 0 => 'Safe (Zero Risk)',
            $this->coliform <= 10 => 'Low Risk',
            $this->coliform <= 100 => 'Intermediate Risk',
            default => 'High Risk',
        };
    }

    // =========================================================================
    // CHEMICAL PARAMETER CHECKS (NDWQS)
    // =========================================================================

    /**
     * Check if pH is within National Standard (6.5 - 8.5)
     */
    public function getPhStatusAttribute(): string
    {
        if (is_null($this->ph)) return 'N/A';
        
        return ($this->ph >= 6.5 && $this->ph <= 8.5) 
            ? 'Compliant' 
            : 'Non-Compliant';
    }

    /**
     * Check if Turbidity is within National Standard (< 5 NTU)
     */
    public function getTurbidityStatusAttribute(): string
    {
        if (is_null($this->turbidity)) return 'N/A';

        // NDWQS Standard: Max 5 NTU (10 in special circumstances, keeping strict 5 here)
        return ($this->turbidity <= 5) 
            ? 'Compliant' 
            : 'Non-Compliant';
    }

    /**
     * Check Free Residual Chlorine (0.1 - 0.5 mg/L recommended at consumption)
     */
    public function getFrcStatusAttribute(): string
    {
        if (is_null($this->frc)) return 'N/A';

        // 0 means no protection against re-contamination
        if ($this->frc == 0) return 'No Chlorine';
        
        // NDWQS usually suggests min 0.1 or 0.2
        return ($this->frc >= 0.1) 
            ? 'Adequate' 
            : 'Low';
    }
}