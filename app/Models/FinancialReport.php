<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_id', 'district', 'palika', 'sector', 'sub_schemes',
        'estimated_total', 'helvetas_actual', 'rms_actual', 
        'users_actual', 'others_actual', 'actual_expenditure_total'
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
