<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HouseholdSanitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_id', 'district', 'palika', 'donor', 'scheme_start_year', 'scheme_name',
        'hh_beneficiaries', 'hh_having_toilets', 'hh_having_chang',
        'hh_having_handwash_station', 'hh_having_filter', 'hh_having_waste_disposal_system'
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
