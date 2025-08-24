<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubsidyItem extends Model
{
    protected $fillable = [
        'subsidy_id',
        'category_name',
        'item_name',
        'total_estimated',
        'advance_1',
        'advance_2',
        'advance_3',
        'settlement_1',
        'settlement_2',
        'settlement_3',
    ];

    public function subsidy(): BelongsTo
    {
        return $this->belongsTo(Subsidy::class);
    }
}
