<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserCommittee extends Model
{
    use HasFactory;

    protected $table = 'user_committees';

    protected $fillable = [
        'scheme_code',
        'user_committee_name',
        'date_of_formation',
        'user_committee_bank_account_name',
        'user_committee_bank_account_number',

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
        'registration_status',
        'registration_number',
        'contract_date',
        'contract_expiry_date',
        'remarks',
    ];

    /**
     * Relationship: Belongs to a Scheme via scheme_code
     */
    public function scheme(): BelongsTo
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }

    /**
     * Computed totals for reporting
     */
    public function getDalitTotalAttribute(): int
    {
        return (int)$this->dalit_female_key + (int)$this->dalit_male_key +
               (int)$this->dalit_female_member + (int)$this->dalit_male_member;
    }

    public function getJanjatiTotalAttribute(): int
    {
        return (int)$this->janjati_female_key + (int)$this->janjati_male_key +
               (int)$this->janjati_female_member + (int)$this->janjati_male_member;
    }

    public function getOthersTotalAttribute(): int
    {
        return (int)$this->others_female_key + (int)$this->others_male_key +
               (int)$this->others_female_member + (int)$this->others_male_member;
    }

    public function getMembersTotalAttribute(): int
    {
        return $this->dalit_total + $this->janjati_total + $this->others_total;
    }
}