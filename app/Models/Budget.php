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
        'helvetas_cash_estimated',
        'helvetas_cash_actual',
        'helvetas_kind_estimated',
        'helvetas_kind_actual',
        'helvetas_total_estimated',
        'helvetas_total_actual',
        'users_estimated',
        'users_actual',
        'individual_private_tap_estimated',
        'individual_private_tap_actual',
        'palika_estimated',
        'palika_actual',
        'total_estimated',
        'total_actual',
        'remarks',
        'budget_status',
    ];

    protected $casts = [
        'helvetas_cash_estimated' => 'decimal:2',
        'helvetas_cash_actual' => 'decimal:2',
        'helvetas_kind_estimated' => 'decimal:2',
        'helvetas_kind_actual' => 'decimal:2',
        'helvetas_total_estimated' => 'decimal:2',
        'helvetas_total_actual' => 'decimal:2',
        'users_estimated' => 'decimal:2',
        'users_actual' => 'decimal:2',
        'individual_private_tap_estimated' => 'decimal:2',
        'individual_private_tap_actual' => 'decimal:2',
        'palika_estimated' => 'decimal:2',
        'palika_actual' => 'decimal:2',
        'total_estimated' => 'decimal:2',
        'total_actual' => 'decimal:2',
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
        // Placeholder for the "year maker"
        $yearMaker = 'YYYY'; // Replace dynamically later based on FY, grant cycle, etc.

        // Count budgets for this scheme in the current convention
        // Here we just use scheme_code + created_at year as placeholder
        $count = self::where('scheme_code', $schemeCode)
            ->whereYear('created_at', now()->year) // can adjust later
            ->count() + 1;

        $seq = str_pad($count, 2, '0', STR_PAD_LEFT);

        return "BUD-{$schemeCode}-{$yearMaker}-{$seq}";
    }

}
