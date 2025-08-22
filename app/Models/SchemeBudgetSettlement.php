<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeBudgetSettlement extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_budget_monitoring_id',
        'settled_amount',
        'approved',
        'recovered',
    ];

    public function monitoring()
    {
        return $this->belongsTo(SchemeBudgetMonitoring::class, 'scheme_budget_monitoring_id');
    }
}
