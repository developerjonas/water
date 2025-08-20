<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicAudit extends Model
{
    use HasFactory;

    protected $table = 'public_audits';

    protected $fillable = [
        'scheme_code',
        'audit_type',
        'audit_date',
        'participant_counts',
        'audit_documents',
    ];

    protected $casts = [
        'participant_counts' => 'array', // JSON cast for flexible participant data
        'audit_documents' => 'array',     // JSON cast for multiple scanned files
        'audit_date' => 'date',           // Carbon instance for date handling
    ];

    /**
     * Optional: relationship to Scheme
     */
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }

    /**
     * Helper: get total participants
     */
    public function getTotalParticipantsAttribute(): int
    {
        if (is_array($this->participant_counts)) {
            return array_sum($this->participant_counts);
        }
        return 0;
    }
}
