<?php

namespace App\Actions\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\GpsPhoto;
use Illuminate\Support\Str; // <--- Added this import

class GpsPhotoReportGenerator
{
    protected GpsPhoto $record;

    public function __construct(GpsPhoto $record)
    {
        // Load scheme relationship if available to show scheme details context
        $this->record = $record->loadMissing(['scheme']); 
    }

    public function generatePdf(): \Barryvdh\DomPDF\PDF
    {
        return Pdf::loadView('pdf.gps', [
            'record' => $this->record,
        ])->setPaper('a4', 'portrait');
    }

    public function downloadPdf(string $filename = null)
    {
        $code = $this->record->scheme_code ?? 'Unknown';
        // Fixed: str_slug() -> Str::slug()
        $system = Str::slug($this->record->water_system_name); 
        $filename ??= "GPS-Report-{$code}-{$system}.pdf";

        return $this->generatePdf()->download($filename);
    }

    public function streamPdf(string $filename = null)
    {
        $code = $this->record->scheme_code ?? 'Unknown';
        // Fixed: str_slug() -> Str::slug()
        $system = Str::slug($this->record->water_system_name);
        $filename ??= "GPS-Report-{$code}-{$system}.pdf";

        return response()->streamDownload(function () {
            echo $this->generatePdf()->output();
        }, $filename);
    }
}