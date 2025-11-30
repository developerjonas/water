<?php

namespace App\Actions\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Scheme;

class SchemeReportGenerator
{
    protected Scheme $scheme;

    public function __construct(Scheme $scheme)
    {
        // Eager load relationships required for the new report layout
        $this->scheme = $scheme->load(['province', 'district', 'municipality']);
    }

    public function generatePdf(): \Barryvdh\DomPDF\PDF
    {
        // Load all related data
        // Fix: Use 'structure' (singular) as defined in Model. Wrap in array because View expects a loop.
        $structure = $this->scheme->structure;
        $structures = $structure ? [$structure] : [];

        // Fix: Add null coalescing (?? []) to prevent 'null given to foreach' errors for other relations
        $beneficiaries = $this->scheme->beneficiaries ?? [];
        
        // Note: Check if your Scheme model has 'waterQualityTests', if not, this defaults to empty to prevent crash
        $waterQualityTests = $this->scheme->waterQualityTests ?? []; 
        
        // Note: Your model likely has 'wsuc' instead of 'userCommittee'. mapping safely:
        $userCommittee = $this->scheme->wsuc ?? $this->scheme->userCommittee ?? [];
        
        $trainings = $this->scheme->trainings ?? [];

        return Pdf::loadView('pdf.scheme', [
            'scheme' => $this->scheme,
            'beneficiaries' => $beneficiaries,
            'structures' => $structures,
            'waterQualityTests' => $waterQualityTests,
            'userCommittee' => $userCommittee,
            'trainings' => $trainings,
        ])->setPaper('a4', 'portrait');
    }

    public function downloadPdf(string $filename = null)
    {
        $code = $this->scheme->scheme_code_user ?? $this->scheme->scheme_code;
        $filename ??= "Scheme-Report-{$code}.pdf";

        return $this->generatePdf()->download($filename);
    }

    /**
     * THIS WAS THE MISSING METHOD
     */
    public function streamPdf(string $filename = null)
    {
        $code = $this->scheme->scheme_code_user ?? $this->scheme->scheme_code;
        $filename ??= "Scheme-Report-{$code}.pdf";

        return response()->streamDownload(function () {
            echo $this->generatePdf()->output();
        }, $filename);
    }
}