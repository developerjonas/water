<?php

namespace App\Actions\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PublicAudit;

class PublicAuditReportGenerator
{
    protected PublicAudit $audit;

    public function __construct(PublicAudit $audit)
    {
        // Eager load scheme
        $this->audit = $audit->load(['scheme']);
    }

    public function generatePdf(): \Barryvdh\DomPDF\PDF
    {
        // Calculate totals for the report
        $counts = $this->audit->participant_counts ?? [];
        $total = 0;
        foreach($counts as $val) { $total += (int)$val; }

        return Pdf::loadView('pdf.audit', [
            'audit' => $this->audit,
            'scheme' => $this->audit->scheme,
            'counts' => $counts,
            'total_participants' => $total
        ])->setPaper('a4', 'portrait');
    }

    public function streamPdf(string $filename = null)
    {
        $code = $this->audit->scheme_code;
        $type = str_replace(' ', '-', $this->audit->audit_type);
        $filename ??= "PublicAudit-{$type}-{$code}.pdf";

        return response()->streamDownload(function () {
            echo $this->generatePdf()->output();
        }, $filename);
    }
}