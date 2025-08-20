<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaterQualityTest extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'water_quality_tests';

    // Mass-assignable attributes
    protected $fillable = [
        'scheme_code',
        'water_quality_tested_point_name',
        'e_coli',
        'coliform',
        'ph',
        'frc',
        'turbidity',
        'e_coli_risk_category',
        'e_coli_risk_zone',
        'coliform_risk_category',
        'coliform_risk_zone',
    ];

    /**
     * Relationship: Each Water Quality Test belongs to a Scheme
     */
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }
}
