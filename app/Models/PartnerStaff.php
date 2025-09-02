<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerStaff extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_code',
        'name',
        'email',
        'phone',
        'position',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_code', 'partner_code');
    }
}
