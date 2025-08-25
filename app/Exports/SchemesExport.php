<?php

namespace App\Exports;

use App\Models\Scheme;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SchemesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Scheme::all([
            'id',
            'scheme_name',
            'province',
            'district',
            'mun',
            'progress_status',
        ]);
    }

    public function headings(): array
    {
        return [
            'ID',
            'Scheme Name',
            'Province',
            'District',
            'Municipality',
            'Progress Status',
            'Budget',
        ];
    }
}
