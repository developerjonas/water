<?php

namespace App\Actions\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\WaterPoint;

class WaterPointReportGenerator
{
    protected WaterPoint $waterPoint;

    public function __construct(WaterPoint $waterPoint)
    {
        // Eager load the parent scheme to show context in the report
        $this->waterPoint = $waterPoint->load(['scheme']);
    }

    public function generatePdf(): \Barryvdh\DomPDF\PDF
    {
        return Pdf::loadView('pdf.water-point', [
            'wp' => $this->waterPoint,
            'scheme' => $this->waterPoint->scheme, // Pass parent scheme separately for cleaner view code
        ])->setPaper('a4', 'portrait');
    }

    public function downloadPdf(string $filename = null)
    {
        // Filename: WaterPoint-WPName-SchemeCode.pdf
        $cleanName = str_replace(' ', '-', $this->waterPoint->water_point_name);
        $filename ??= "WaterPoint-{$cleanName}.pdf";

        return $this->generatePdf()->download($filename);
    }

    public function streamPdf(string $filename = null)
    {
        $cleanName = str_replace(' ', '-', $this->waterPoint->water_point_name);
        $filename ??= "WaterPoint-{$cleanName}.pdf";

        return response()->streamDownload(function () {
            echo $this->generatePdf()->output();
        }, $filename);
    }
}