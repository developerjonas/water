<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StructureInfo extends Model
{
    protected $fillable = [
        'scheme_id',
        'intake_estimated', 'intake_achieved',
        'intake_filter_estimated', 'intake_filter_achieved',
        'dc_ic_cc_estimated', 'dc_ic_cc_achieved',
        'rvt_estimated', 'rvt_achieved',
        'bpt_estimated', 'bpt_achieved',
        'frc_estimated', 'frc_achieved',
        'private_tap_estimated', 'private_tap_achieved',
        'institutional_tap_estimated', 'institutional_tap_achieved',
        'transmission_line_estimated', 'transmission_line_achieved',
        'distribution_line_estimated', 'distribution_line_achieved',
        'private_line_estimated', 'private_line_achieved',
    ];

    /**
     * Get the scheme that owns this structure info.
     */
    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
