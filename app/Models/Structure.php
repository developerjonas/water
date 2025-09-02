<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_code',

        // Intakes & RVTs
        'intakes_planned',
        'intakes_constructed',
        'intakes_remaining',
        'rvts_planned',
        'rvts_constructed',
        'rvts_remaining',

        // Structures
        'cc_dc_bpt_planned',
        'cc_dc_bpt_constructed',
        'cc_dc_bpt_remaining',
        'other_structures_planned',
        'other_structures_constructed',
        'other_structures_remaining',

        // Taps
        'public_taps_planned',
        'public_taps_constructed',
        'public_taps_remaining',
        'school_taps_planned',
        'school_taps_constructed',
        'school_taps_remaining',
        'private_taps_planned',
        'private_taps_constructed',
        'private_taps_remaining',

        // Lines
        'transmission_line_planned',
        'transmission_line_constructed',
        'transmission_line_remaining',
        'distribution_line_planned',
        'distribution_line_constructed',
        'distribution_line_remaining',
        'private_line_planned',
        'private_line_constructed',
        'private_line_remaining',

        // Remarks
        'remarks',
    ];

    /**
     * Relationships
     */
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }
}
