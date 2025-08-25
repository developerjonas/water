<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingType extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [
        'name',
        'level',
        'is_active',
    ];

    // Casts
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relationship: One TrainingType has many Trainings
     */
    public function trainingRecords(): HasMany
    {
        return $this->hasMany(Training::class);
    }

    /**
     * Scope: only active training types
     */
    // public function scopeActive($query)
    // {
    //     return $query->where('is_active', true);
    // }
}
