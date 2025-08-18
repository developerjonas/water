<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'scheme_id',
        'training_type',
        'training_name',
        'training_start_date',
        'training_end_date',
        'training_days',
        'training_place',
        'facilitator_name',
        'num_participating_schools',
        'teacher_count',
        'child_club_count',
        'school_mgmt_committee_count',
        'dalit_male',
        'dalit_female',
        'dalit_total',
        'janjati_male',
        'janjati_female',
        'janjati_total',
        'other_male',
        'other_female',
        'other_total',
        'male_total',
        'female_total',
        'total',
        'num_schemes_participants',
        'other'
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function participants()
    {
        return $this->hasMany(TrainingParticipant::class, 'training_code', 'code');
    }
}
