<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'budget_id',
        'file_path',
        'monitoring_date',
        'remarks',
    ];

    protected $casts = [
        'monitoring_date' => 'date',
    ];

    public function budget()
    {
        return $this->belongsTo(Budget::class);
    }

    public function scheme()
    {
        return $this->hasOneThrough(
            Scheme::class,
            Budget::class,
            'id',           // Foreign key on Budget
            'scheme_code',  // Foreign key on Scheme
            'budget_id',    // Local key on BudgetMonitoring
            'scheme_code'   // Local key on Budget
        );
    }
}
