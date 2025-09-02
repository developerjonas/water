<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'partner_code',
        'name',
        'email',
        'address',
        'contact_number',
        'contact_person',
    ];

    /**
     * Get the staff members associated with this partner.
     */
    public function staff()
    {
        return $this->hasMany(PartnerStaff::class, 'partner_code', 'partner_code');
    }

    public function narrativeReports()
    {
        return $this->hasMany(
            PartnerNarrativeReport::class, 'partner_code', 'partner_code' 
        );
    }
}
