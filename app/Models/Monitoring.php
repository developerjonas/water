<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monitoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'monitoring_code',
        'scheme_code',
        'budget_code',
        'monitoring_date',
        'monitored_by',
        'status',
        'remarks',
        'attachments',
    ];

    protected $casts = [
        'monitoring_date' => 'date',
        'attachments' => 'array', // for multiple file uploads
    ];

    /**
     * Relationship: Monitoring belongs to a Scheme.
     */
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }

    /**
     * Relationship: Monitoring belongs to a Budget.
     */
    public function budget()
    {
        return $this->belongsTo(Budget::class, 'budget_code', 'budget_code');
    }
}
