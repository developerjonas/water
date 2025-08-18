<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstallmentMonitoring extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'scheme_id',
        'installment_number',
        'installment_date',
        'installment_amount',
        'monitoring_type',
        'monitoring_date',
    ];

    /**
     * Relationships
     */

    // Each installment belongs to a scheme
    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
