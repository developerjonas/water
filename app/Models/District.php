<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['province_id', 'code', 'name', 'is_active'];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }
}
