<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_code',
        'full_name',
        'address',
        'phone',
        'email',
        'school_name',
        'teacher_name',
        'child_club',
        'school_management_committee',
        'number_of_schemes',
        'event_name',
    ];

    // Optional: relation to Training if you have Training model
    public function training()
    {
        return $this->belongsTo(Training::class, 'training_code', 'code');
    }
}
