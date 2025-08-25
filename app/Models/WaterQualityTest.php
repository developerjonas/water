<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterQualityTest extends Model
{
    use HasFactory;

    protected $table = 'water_quality_tests';

    protected $fillable = [
        'scheme_code',
        'water_point_id',
        'tested_point',
        'ecoli',
        'coliform',
        'ph',
        'frc',
        'turbidity',
        'remarks',
    ];

    /**
     * Relation: belongs to a scheme
     */
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }

    /**
     * Compute E.coli risk category dynamically
     */
    public function getEcoliRiskAttribute()
    {
        if ($this->ecoli === null) return null;
        if ($this->ecoli === 0) return 'No Risk';
        if ($this->ecoli <= 10) return 'Low Risk';
        if ($this->ecoli <= 100) return 'Risk';
        return 'High Risk';
    }

    /**
     * Compute Coliform risk category dynamically
     */
    public function getColiformRiskAttribute()
    {
        if ($this->coliform === null) return null;
        if ($this->coliform === 0) return 'No Risk';
        if ($this->coliform <= 10) return 'Low Risk';
        if ($this->coliform <= 100) return 'Risk';
        return 'High Risk';
    }

    public function waterPoint()
    {
        return $this->belongsTo(WaterPoint::class);
    }

}
