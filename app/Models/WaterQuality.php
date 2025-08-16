<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WaterQuality extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'scheme_id',
        'district',
        'r_m_palika',
        'tested_point',
        'e_coli',
        'coliform',
        'ph',
        'frc',
        'turbidity',
        'e_coli_risk_category',
        'e_coli_percentage',
        'e_coli_risk_zone',
        'coliform_risk_category',
        'coliform_percentage',
        'coliform_risk_zone',
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
