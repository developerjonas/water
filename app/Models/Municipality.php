<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Municipality extends Model
{
    use HasFactory;

    protected $fillable = ['district_id', 'code', 'name', 'is_active'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
