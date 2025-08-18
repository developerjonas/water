<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'water_system_name',
        'community_name',
        'location_type',
        'water_point_name',
        'hh_count',
        'taps_count',
        'total_users',
        'unique_users',
        'latitude',
        'longitude',
        'photos',
        'plaque_photo',
        'remarks',
    ];

    protected $casts = [
        'photos' => 'array',
        'latitude' => 'decimal:6',
        'longitude' => 'decimal:6',
    ];
}
