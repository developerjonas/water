<?php

namespace App\Actions\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Response;

class PdfExporter
{
    protected string $view;
    protected array $data = [];
    protected string $filename = 'export.pdf';

    public function __construct(string $view)
    {
        $this->view = $view;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;
        return $this;
    }

    public function download()
    {
        $pdf = Pdf::loadView($this->view, $this->data);

        return Response::streamDownload(
            fn() => print($pdf->output()),
            $this->filename
        );
    }
}
