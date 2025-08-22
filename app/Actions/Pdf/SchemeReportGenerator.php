<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Scheme;

class SchemeReportGenerator
{
    protected Scheme $scheme;

    public function __construct(Scheme $scheme)
    {
        $this->scheme = $scheme;
    }

    public function generatePdf(): \Barryvdh\DomPDF\PDF
    {
        // Load all related data
        $beneficiaries = $this->scheme->beneficiaries;
        $structures = $this->scheme->structures;
        $waterQualityTests = $this->scheme->waterQualityTests;
        $userCommittee = $this->scheme->userCommittee;
        $trainings = $this->scheme->trainings;

        // Pass to a view
        return Pdf::loadView('pdf.scheme-report', [
            'scheme' => $this->scheme,
            'beneficiaries' => $beneficiaries,
            'structures' => $structures,
            'waterQualityTests' => $waterQualityTests,
            'userCommittee' => $userCommittee,
            'trainings' => $trainings,
        ]);
    }

    public function downloadPdf(string $filename = null)
    {
        $filename ??= $this->scheme->scheme_code . '-report.pdf';
        return $this->generatePdf()->download($filename);
    }
}
