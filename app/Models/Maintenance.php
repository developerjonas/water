<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_id', 'district', 'palika', 'donor', 'scheme_start_year', 'scheme_name',
        'bank_name', 'account_no', 'account_name',
        'fund_collected_last_year', 'fund_collection_per_hh',
        'total_fund_collection_this_year', 'total_fund_till_date',
        'expenditure_till_date', 'hh_beneficiaries', 'total_taps',
        'maintenance_fund_per_tap'
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
