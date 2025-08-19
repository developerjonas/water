<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicAudit extends Model
{
    use HasFactory;

    protected $table = 'public_audits';

    // Allow mass assignment for these fields
    protected $fillable = [
        'scheme_code',
        'audit_type',
        'dalit_female',
        'dalit_male',
        'janjati_female',
        'janjati_male',
        'other_female',
        'other_male',
    ];

    // Computed total, optional if you don't use the DB virtual column
    protected $appends = ['computed_total'];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }

    // Optional accessor if your DB doesn't support virtual columns
    public function getComputedTotalAttribute()
    {
        return $this->dalit_female 
             + $this->dalit_male 
             + $this->janjati_female 
             + $this->janjati_male 
             + $this->other_female 
             + $this->other_male;
    }
}
