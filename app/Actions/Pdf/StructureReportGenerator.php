<?php

namespace App\Actions\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Structure;

class StructureReportGenerator
{
    protected Structure $structure;

    public function __construct(Structure $structure)
    {
        // Eager load the Scheme and its location relationships for the report header
        $this->structure = $structure->load(['scheme.provinceRelation', 'scheme.districtRelation', 'scheme.municipalityRelation']);
    }

    public function generatePdf(): \Barryvdh\DomPDF\PDF
    {
        return Pdf::loadView('pdf.structure', [
            'structure' => $this->structure,
            'scheme' => $this->structure->scheme, // Pass scheme separately for easier access in view
        ])->setPaper('a4', 'portrait');
    }

    public function downloadPdf(string $filename = null)
    {
        $code = $this->structure->scheme->scheme_code ?? 'UNKNOWN';
        $filename ??= "Structure-Report-{$code}.pdf";

        return $this->generatePdf()->download($filename);
    }

    public function streamPdf(string $filename = null)
    {
        $code = $this->structure->scheme->scheme_code ?? 'UNKNOWN';
        $filename ??= "Structure-Report-{$code}.pdf";

        return response()->streamDownload(function () {
            echo $this->generatePdf()->output();
        }, $filename);
    }
}