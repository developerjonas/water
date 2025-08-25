<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_code', 'water_point_id','district', 'palika', 'water_system_name', 'location_type',
        'water_point_name', 'source_details', 'hardware_details',
        'latitude', 'longitude', 'photo_url'
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function qualityTests()
    {
        return $this->hasMany(WaterQualityTest::class);
    }
}
