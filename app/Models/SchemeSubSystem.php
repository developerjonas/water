<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SchemeSubSystem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'scheme_code',
        'name',
        'type',
        'sequence',
        'is_active',
    ];

    // Relation to Scheme via scheme_code
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }

    // Scope: only active subsystems
    // public function scopeActive($query)
    // {
    //     return $query->where('is_active', true);
    // }
}
