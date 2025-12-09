<?php

namespace App\Actions\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\WaterQualityTest;

class WaterQualityReportGenerator
{
    protected WaterQualityTest $test;

    public function __construct(WaterQualityTest $test)
    {
        // Eager load Scheme and Water Point to avoid N+1 queries in the view
        $this->test = $test->load(['scheme', 'waterPoint']);
    }

    public function generatePdf(): \Barryvdh\DomPDF\PDF
    {
        return Pdf::loadView('pdf.test', [
            'test' => $this->test,
            'scheme' => $this->test->scheme,
        ])->setPaper('a4', 'portrait');
    }

    public function streamPdf(string $filename = null)
    {
        $date = $this->test->test_date?->format('Y-m-d') ?? 'Undated';
        $pointName = str_replace(' ', '-', $this->test->tested_point_name);
        $filename ??= "WQ-Report-{$pointName}-{$date}.pdf";

        return response()->streamDownload(function () {
            echo $this->generatePdf()->output();
        }, $filename);
    }
}