<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subsidy extends Model
{
    protected $fillable = [
        'scheme_code',
        'total_estimated',
        'helvetas_cash',
        'helvetas_kind',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(SubsidyItem::class);
    }

    public function scheme(): BelongsTo
    {
        return $this->belongsTo(Scheme::class);
    }
}
