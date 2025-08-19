<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheme_id',
        'type',
        'estimated',
        'achieved',
    ];

    /**
     * Relation to the Scheme model.
     */
    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    /**
     * Available structure types.
     *
     * You can reuse this in forms for dropdowns.
     */
    public static function getStructureTypes(): array
    {
        return [
            'Intake',
            'Intake Filter',
            'DC/IC/CC',
            'RVT',
            'BPT',
            'FRC',
            'Private Tap',
            'Institutional Tap',
            'Transmission Line',
            'Distribution Line',
            'Private Line',
        ];
    }
}
