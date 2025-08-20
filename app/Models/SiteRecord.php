<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteRecord extends Model
{
    use HasFactory;

    protected $table = 'site_records';

    protected $fillable = [
        'scheme_code',
        'scheme_name',
        'water_system_name',
        'location_type',
        'water_point_name',
        'source_details',
        'hardware_details',
        'photos',
        'plaque_photo',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'photos' => 'array',
        'plaque_photo' => 'array',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    // Optional: relationship to Scheme
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }
}
