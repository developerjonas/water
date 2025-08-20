<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'beneficiaries';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'scheme_code',
        // Household
        'dalit_hh_poor',
        'dalit_hh_nonpoor',
        'aj_hh_poor',
        'aj_hh_nonpoor',
        'other_hh_poor',
        'other_hh_nonpoor',
        // Individuals
        'dalit_female',
        'dalit_male',
        'aj_female',
        'aj_male',
        'others_female',
        'others_male',
        // Schools
        'base_population',
        'boys_student',
        'girls_student',
        'teachers_staff',
    ];

    /**
     * Relationship: Belongs to a Scheme via scheme_code.
     */
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }

    /**
     * Computed properties for totals.
     */
    public function getHouseholdTotalAttribute(): int
    {
        return $this->dalit_hh_poor + $this->dalit_hh_nonpoor +
               $this->aj_hh_poor + $this->aj_hh_nonpoor +
               $this->other_hh_poor + $this->other_hh_nonpoor;
    }

    public function getIndividualTotalAttribute(): int
    {
        return $this->dalit_female + $this->dalit_male +
               $this->aj_female + $this->aj_male +
               $this->others_female + $this->others_male;
    }

    public function getTotalBeneficiariesAttribute(): int
    {
        return $this->household_total + $this->individual_total +
               $this->boys_student + $this->girls_student + $this->teachers_staff;
    }
}
