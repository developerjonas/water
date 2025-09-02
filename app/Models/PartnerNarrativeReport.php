<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerNarrativeReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_code',
        'reporting_period',
        'notes',
        'report_files', // store multiple file URLs as JSON
    ];

    protected $casts = [
        'report_files' => 'array', // automatically cast JSON to array
    ];


    // PartnerNarrativeReport.php
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_code', 'partner_code');
    }

}
