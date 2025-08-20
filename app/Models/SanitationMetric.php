<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanitationMetric extends Model
{
    use HasFactory;

    protected $table = 'sanitation_metrics';

    protected $fillable = [
        'scheme_code',
        'households_total',
        'households_with_toilet',
        'households_with_drying_rack',
        'households_with_handwashing_station',
        'households_using_filter',
        'households_with_waste_disposal_pit',
        'total_sanitation_status',
        'remarks',
    ];

    /**
     * Relationship: SanitationMetric belongs to a Scheme
     */
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }

    /**
     * Optional Accessor: Compare drying racks vs handwashing stations
     */
    public function getDrVsHsAttribute()
    {
        if ($this->households_with_drying_rack === 0 && $this->households_with_handwashing_station === 0) {
            return null;
        }
        return $this->households_with_drying_rack === $this->households_with_handwashing_station ? 'Yes' : 'No';
    }
}
