<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserCommitteeInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_id', 'district', 'palika', 'name', 'position', 'ethnicity_gender', 'contact_no'
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
