<?php

namespace App\Http\Controllers;

use App\Exports\SchemesExport;
use Maatwebsite\Excel\Facades\Excel;

class SchemeController extends Controller
{
    public function export()
    {
        return Excel::download(new SchemesExport, 'schemes.xlsx');
    }
}
