<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'district', 'palika', 'scheme_code', 'scheme_name', 'sector',
        'sub_schemes', 'total_female', 'total_male', 'total_beneficiaries',
        'schools', 'taps_provided', 'boys_students', 'girls_students',
        'teachers', 'total_population'
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
