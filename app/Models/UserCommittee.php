<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCommittee extends Model
{
    use HasFactory;

    protected $table = 'user_committees';

    // Primary key is id (default), timestamps enabled by default

    protected $fillable = [
        'scheme_code',
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

        // Others counts
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
     * Relations
     */
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }
}
