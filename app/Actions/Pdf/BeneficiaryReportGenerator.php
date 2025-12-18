<?php

namespace App\Actions\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Beneficiary;

class BeneficiaryReportGenerator
{
    protected Beneficiary $beneficiary;

    public function __construct(Beneficiary $beneficiary)
    {
        // Eager load Scheme and location context
        $this->beneficiary = $beneficiary->load(['scheme.provinceRelation', 'scheme.districtRelation', 'scheme.municipalityRelation']);
    }

    public function generatePdf(): \Barryvdh\DomPDF\PDF
    {
        return Pdf::loadView('pdf.beneficiary', [
            'data' => $this->beneficiary,
            'scheme' => $this->beneficiary->scheme,
        ])->setPaper('a4', 'portrait');
    }

    public function downloadPdf(string $filename = null)
    {
        $code = $this->beneficiary->scheme->scheme_code ?? 'UNKNOWN';
        $filename ??= "Beneficiary-Report-{$code}.pdf";

        return $this->generatePdf()->download($filename);
    }

    public function streamPdf(string $filename = null)
    {
        $code = $this->beneficiary->scheme->scheme_code ?? 'UNKNOWN';
        $filename ??= "Beneficiary-Report-{$code}.pdf";

        return response()->streamDownload(function () {
            echo $this->generatePdf()->output();
        }, $filename);
    }
}