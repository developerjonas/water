<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $table = 'budgets';

    protected $fillable = [
        'scheme_code',
        'budget_code',
        
        // Helvetas
        'helvetas_estimated_cash',
        'helvetas_estimated_kind',
        'helvetas_estimated_total',
        
        // Contributions
        'community_contribution',
        'palika_estimated',
        
        // Grand Total
        'total_estimated',
        
        // Meta
        'remarks',
        'budget_status',
    ];

    protected $casts = [
        'helvetas_estimated_cash' => 'decimal:2',
        'helvetas_estimated_kind' => 'decimal:2',
        'helvetas_estimated_total' => 'decimal:2',
        'community_contribution' => 'decimal:2',
        'palika_estimated' => 'decimal:2',
        'total_estimated' => 'decimal:2',
    ];

    // Relationship to Scheme
    public function scheme()
    {
        return $this->belongsTo(Scheme::class, 'scheme_code', 'scheme_code');
    }

    // Helper: check if budget is verified
    public function isVerified(): bool
    {
        return $this->budget_status === 'verified';
    }

    // Auto-generate Budget Code on creation
    protected static function booted()
    {
        static::creating(function ($budget) {
            if (empty($budget->budget_code)) {
                $budget->budget_code = self::generateBudgetCode($budget->scheme_code);
            }
        });
    }

    protected static function generateBudgetCode($schemeCode)
    {
        // Example: BUD-SCHEME001-2024-01
        $year = now()->year;

        // Count existing budgets for this scheme this year to increment sequence
        $count = self::where('scheme_code', $schemeCode)
            ->whereYear('created_at', $year)
            ->count() + 1;

        $seq = str_pad($count, 2, '0', STR_PAD_LEFT);

        return "BUD-{$schemeCode}-{$year}-{$seq}";
    }
}