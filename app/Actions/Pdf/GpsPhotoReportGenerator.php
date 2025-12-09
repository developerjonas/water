<?php

namespace App\Actions\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\GpsPhoto;

class GpsPhotoReportGenerator
{
    protected GpsPhoto $record;

    public function __construct(GpsPhoto $record)
    {
        // Eager load scheme to show context in the report
        $this->record = $record->load(['scheme']);
    }

    public function generatePdf(): \Barryvdh\DomPDF\PDF
    {
        return Pdf::loadView('pdf.gps', [
            'photo' => $this->record,
            'scheme' => $this->record->scheme,
        ])->setPaper('a4', 'portrait');
    }

    public function streamPdf(string $filename = null)
    {
        $systemName = str_replace(' ', '-', $this->record->water_system_name);
        $filename ??= "GPS-Photo-{$systemName}-{$this->record->id}.pdf";

        return response()->streamDownload(function () {
            echo $this->generatePdf()->output();
        }, $filename);
    }
}