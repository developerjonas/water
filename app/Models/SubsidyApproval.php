<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubsidyApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_code',
        'approve_subsidy',
        'remarks',
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }

    public function items()
    {
        return $this->hasMany(SubsidyItem::class);
    }
}
