<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_code',
        'intakes_constructed',
        'intakes_remaining',
        'rvts_constructed',
        'rvts_remaining',
        'cc_dc_bpt_constructed',
        'cc_dc_bpt_remaining',
        'other_structures_constructed',
        'other_structures_remaining',
        'public_taps',
        'school_taps',
        'private_taps',
        'taps_constructed_progress',
        'taps_remaining',
        'transmission_line_progress',
        'transmission_line_remaining',
        'distribution_line_progress',
        'distribution_line_remaining',
        'private_line_progress',
        'private_line_remaining',
        'mb_submitted_to_municipality',
        'municipality_contribution_transferred',
        'public_hearing_done',
        'public_review_done',
        'final_public_audit_done',
        'remarks',
    ];

    // -------------------
    // Relationships
    // -------------------
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }
}
