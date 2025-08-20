<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GpsPhoto extends Model
{
    use HasFactory;

    protected $table = 'gps_photos';

    protected $fillable = [
        'scheme_code',
        'scheme_name',
        'water_system_name',
        'location_type',
        'source_type',
        'hardware_type',
        'structure_photos',
        'plaque_photos',
        'latitude',
        'longitude',
        'remarks',
    ];

    protected $casts = [
        'structure_photos' => 'array',
        'plaque_photos' => 'array',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    // Relationship to Scheme
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }
}
