<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicAudit extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_id', 'district', 'palika', 'donor', 'scheme_start_year', 'scheme_name',
        'audit_name', 'audit_date', 'df', 'dm', 'jf', 'jm', 'of', 'om'
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}

