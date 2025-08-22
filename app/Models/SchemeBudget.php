<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeBudget extends Model
{
    use HasFactory;

    // Table name (optional if following convention)
    protected $table = 'scheme_budgets';

    // Mass assignable fields
    protected $fillable = [
        'scheme_code',
        'sub_schemes',
        'estimated_amount',
        'estimated_helvetas_cash',
        'estimated_helvetas_kd',
        'estimated_municipality',
        'estimated_users',
        'estimated_others',
        'actual_amount',
        'actual_helvetas_cash',
        'actual_helvetas_kd',
        'actual_municipality',
        'actual_users',
        'actual_others',
    ];

    /**
     * Relationship: Each budget belongs to a scheme
     */
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'id');
    }

}
