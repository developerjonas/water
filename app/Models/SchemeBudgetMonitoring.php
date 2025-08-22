<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeBudgetMonitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_budget_installment_id',
        'description',
        'estimated_amount',
        'spent_amount',
        'verified',
    ];

    public function installment()
    {
        return $this->belongsTo(SchemeBudgetInstallment::class, 'scheme_budget_installment_id');
    }

    public function settlements()
    {
        return $this->hasMany(SchemeBudgetSettlement::class);
    }
}
