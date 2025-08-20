<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'donors';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'contact_person',
        'email',
        'phone',
        'address',
        'remarks',
    ];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'contact_person' => 'array', // JSON array
    ];


    public function schemes()
    {
        return $this->hasMany(Scheme::class);
    }

}
