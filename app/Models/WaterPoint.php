<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_code',           // Foreign key to schemes
        'sub_system_name',       // Water Sub-System / Sub-Scheme Name
        'water_point_name',      // Water Point Name
        'location_type',         // Location type: community, school, health_center, public_institution, other
        'woman',                 // Number of female users
        'man',                   // Number of male users
        'total_water_users',     // Calculated: woman + man
        'tap_construction_status', // yes / no
        'remarks',               // Optional remarks
    ];

    /**
     * Relationship: WaterPoint belongs to a Scheme
     */
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }

    /**
     * Automatically calculate total water users
     */
    public function setTotalWaterUsersAttribute($value)
    {
        $this->attributes['total_water_users'] = $this->woman + $this->man;
    }
}
