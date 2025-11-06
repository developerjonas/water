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
        // Household Beneficiaries
        'dalit_hh_poor',
        'dalit_hh_nonpoor',
        'aj_hh_poor',
        'aj_hh_nonpoor',
        'other_hh_poor',
        'other_hh_nonpoor',
        // Individual Beneficiaries - Male
        'dalit_male',
        'aj_male',
        'others_male',
        // Individual Beneficiaries - Female
        'dalit_female',
        'aj_female',
        'others_female',
        // Other Population
        'base_population',
        // School Beneficiaries
        'total_schools',
        'boys_student',
        'girls_student',
        'teachers_staff',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'dalit_hh_poor' => 'integer',
        'dalit_hh_nonpoor' => 'integer',
        'aj_hh_poor' => 'integer',
        'aj_hh_nonpoor' => 'integer',
        'other_hh_poor' => 'integer',
        'other_hh_nonpoor' => 'integer',
        'dalit_male' => 'integer',
        'aj_male' => 'integer',
        'others_male' => 'integer',
        'dalit_female' => 'integer',
        'aj_female' => 'integer',
        'others_female' => 'integer',
        'base_population' => 'integer',
        'total_schools' => 'integer',
        'boys_student' => 'integer',
        'girls_student' => 'integer',
        'teachers_staff' => 'integer',
    ];

    /**
     * Relationship: Belongs to a Scheme via scheme_code.
     */
    public function scheme()
{
    return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
}

    /**
     * Computed property: total households.
     */
    public function getHouseholdTotalAttribute(): int
    {
        return $this->dalit_hh_poor + $this->dalit_hh_nonpoor +
               $this->aj_hh_poor + $this->aj_hh_nonpoor +
               $this->other_hh_poor + $this->other_hh_nonpoor;
    }

    /**
     * Computed property: total individuals.
     */
    public function getIndividualTotalAttribute(): int
    {
        return $this->dalit_male + $this->aj_male + $this->others_male +
               $this->dalit_female + $this->aj_female + $this->others_female;
    }

    /**
     * Computed property: total school population.
     */
    public function getSchoolTotalAttribute(): int
    {
        return $this->boys_student + $this->girls_student + $this->teachers_staff;
    }

    /**
     * Computed property: total beneficiaries.
     */
    public function getTotalBeneficiariesAttribute(): int
    {
        return $this->household_total + $this->individual_total + $this->school_total + $this->base_population;
    }
}
