<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;

    protected $fillable = ['province_code', 'name', 'is_active'];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
