<?php

namespace App\Actions\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Budget;

class BudgetReportGenerator
{
    protected Budget $budget;

    public function __construct(Budget $budget)
    {
        // Eager load scheme for context
        $this->budget = $budget->load(['scheme']);
    }

    public function generatePdf(): \Barryvdh\DomPDF\PDF
    {
        return Pdf::loadView('pdf.budget', [
            'budget' => $this->budget,
            'scheme' => $this->budget->scheme,
        ])->setPaper('a4', 'portrait');
    }

    public function streamPdf(string $filename = null)
    {
        $code = $this->budget->budget_code ?? $this->budget->id;
        $filename ??= "Budget-Report-{$code}.pdf";

        return response()->streamDownload(function () {
            echo $this->generatePdf()->output();
        }, $filename);
    }
}