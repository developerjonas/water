<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Scopes\SchemeAccessScope;

class WaterPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        // 1. Linking
        'scheme_code',

        // 2. Identification
        'water_point_name',
        'location_type', // Community, School, etc.
        'tole',
        'ward_no', // Kept as string (e.g., "1,2")
        'tap_construction_status', // Yes/No

        // 3. Socio-Economic
        'households_count',
        'ethnicity',      // Dalit, Janjati, etc.
        'economic_status', // Poor, Non-Poor

        // 4. Demographics
        'woman',
        'man',
        'total_users', // Calculated

        // 5. Meta
        'remarks',
    ];

    protected $casts = [
        'households_count' => 'integer',
        'woman' => 'integer',
        'man' => 'integer',
        'total_users' => 'integer',
    ];

    /**
     * Relationship to the Master Scheme
     */
    public function scheme(): BelongsTo
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }

    /**
     * Auto-calculate total users before saving.
     */
    protected static function booted(): void
    {

        static::addGlobalScope(new SchemeAccessScope);

        static::saving(function (WaterPoint $waterPoint) {
            // Ensure integers for calculation
            $man = (int) $waterPoint->man;
            $woman = (int) $waterPoint->woman;
            
            // Auto-update total
            $waterPoint->total_users = $man + $woman;
        });
    }
}