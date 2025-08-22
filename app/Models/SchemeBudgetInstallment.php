<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeBudgetInstallment extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_budget_id',
        'installment_number',
        'municipality',
        'helvetas_cash',
        'helvetas_kd',
        'users',
        'others',
        'total',
    ];

    public function budget()
    {
        return $this->belongsTo(SchemeBudget::class, 'scheme_budget_id');
    }

    public function monitorings()
    {
        return $this->hasMany(SchemeBudgetMonitoring::class);
    }
}
