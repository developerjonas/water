<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCommittee extends Model
{
    use HasFactory;

    protected $table = 'user_committees';

    protected $fillable = [
        'scheme_code',
        'user_committee_name',
        'date_of_formation',
        'user_committee_bank_account_name',

        // Key positions
        'chair_name',
        'chair_contact',
        'vice_chair_name',
        'vice_chair_contact',
        'secretary_name',
        'secretary_contact',
        'deputy_secretary_name',
        'deputy_secretary_contact',
        'treasurer_name',
        'treasurer_contact',

        // Dalit counts
        'dalit_female_key',
        'dalit_male_key',
        'dalit_female_member',
        'dalit_male_member',

        // Janjati counts
        'janjati_female_key',
        'janjati_male_key',
        'janjati_female_member',
        'janjati_male_member',

        // Other counts
        'others_female_key',
        'others_male_key',
        'others_female_member',
        'others_male_member',

        // Status & Contract
        'wusc_registration_status',
        'registration_number',
        'contract_date',
        'contract_expiry_date',
        'remarks',
    ];

    /**
     * Relationship: Belongs to a Scheme via scheme_code
     */
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }

    /**
     * Computed totals for reporting
     */
    public function getDalitTotalAttribute(): int
    {
        return $this->dalit_female_key + $this->dalit_male_key +
               $this->dalit_female_member + $this->dalit_male_member;
    }

    public function getJanjatiTotalAttribute(): int
    {
        return $this->janjati_female_key + $this->janjati_male_key +
               $this->janjati_female_member + $this->janjati_male_member;
    }

    public function getOthersTotalAttribute(): int
    {
        return $this->others_female_key + $this->others_male_key +
               $this->others_female_member + $this->others_male_member;
    }

    public function getMembersTotalAttribute(): int
    {
        return $this->dalit_total + $this->janjati_total + $this->others_total;
    }
}
