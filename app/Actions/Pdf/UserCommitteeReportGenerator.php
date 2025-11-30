<?php

namespace App\Actions\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\UserCommittee;

class UserCommitteeReportGenerator
{
    protected UserCommittee $committee;

    public function __construct(UserCommittee $committee)
    {
        // Eager load Scheme + Location relationships
        $this->committee = $committee->load(['scheme.province', 'scheme.district', 'scheme.municipality']);
    }

    public function generatePdf(): \Barryvdh\DomPDF\PDF
    {
        return Pdf::loadView('pdf.uc', [
            'committee' => $this->committee,
            'scheme'    => $this->committee->scheme,
        ])->setPaper('a4', 'portrait');
    }

    public function downloadPdf(string $filename = null)
    {
        $name = $this->committee->user_committee_name ?? 'Committee';
        // Sanitize filename
        $safeName = str_replace(' ', '-', $name);
        $filename ??= "Committee-Report-{$safeName}.pdf";

        return $this->generatePdf()->download($filename);
    }

    public function streamPdf(string $filename = null)
    {
        $name = $this->committee->user_committee_name ?? 'Committee';
        $safeName = str_replace(' ', '-', $name);
        $filename ??= "Committee-Report-{$safeName}.pdf";

        return response()->streamDownload(function () {
            echo $this->generatePdf()->output();
        }, $filename);
    }
}