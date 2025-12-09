<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Public Audit Report - {{ $audit->id }}</title>
    <style>
        @page { margin: 40px; }
        body { font-family: 'DejaVu Sans', sans-serif; color: #1f2937; font-size: 13px; line-height: 1.4; }
        
        /* Layout */
        .header { text-align: center; border-bottom: 3px solid #0891b2; padding-bottom: 20px; margin-bottom: 30px; }
        .logo { height: 60px; margin-bottom: 10px; }
        h1 { color: #0891b2; font-size: 22px; text-transform: uppercase; margin: 0; }
        .subtitle { font-size: 11px; color: #6b7280; margin-top: 5px; }

        .section-title {
            background: #f3f4f6; border-left: 5px solid #0891b2; 
            padding: 8px 12px; font-weight: bold; font-size: 14px; 
            margin: 25px 0 15px 0; text-transform: uppercase;
        }

        /* Tables */
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { padding: 8px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        th { background-color: #f9fafb; color: #4b5563; font-size: 11px; text-transform: uppercase; }
        td { font-weight: 500; }

        /* Participation Matrix Specifics */
        .matrix-table th { text-align: center; background-color: #e5e7eb; color: #374151; }
        .matrix-table td { text-align: center; }
        .matrix-total { background-color: #ecfdf5; font-weight: bold; color: #065f46; }

        /* Images */
        .image-container { text-align: center; margin-top: 20px; }
        .evidence-img { 
            max-width: 90%; 
            height: auto; 
            max-height: 400px;
            border: 1px solid #ddd; 
            padding: 5px; 
            margin-bottom: 20px;
        }
        
        /* Grid Helper */
        .row::after { content: ""; clear: both; display: table; }
        .col-half { float: left; width: 48%; }
        .col-right { float: right; }
    </style>
</head>
<body>

    {{-- Image Encoder Helper --}}
    @php
        $encodeImage = function($path) {
            $fullPath = storage_path('app/public/' . $path);
            if (!file_exists($fullPath)) return '';
            try {
                $type = pathinfo($fullPath, PATHINFO_EXTENSION);
                $data = file_get_contents($fullPath);
                $base64 = base64_encode($data);
                return 'data:image/' . $type . ';base64,' . $base64;
            } catch (\Exception $e) { return ''; }
        };
    @endphp

    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">
        <h1>Public Audit Report</h1>
        <div class="subtitle">Audit Type: {{ $audit->audit_type }} | Date: {{ $audit->audit_date->format('d M Y') }}</div>
    </div>

    <div class="section-title">1. Scheme Context</div>
    <div class="row">
        <div class="col-half">
            <table>
                <tr><th>Scheme Name</th><td>{{ $scheme->scheme_name ?? 'N/A' }}</td></tr>
                <tr><th>System Code</th><td>{{ $audit->scheme_code }}</td></tr>
            </table>
        </div>
        <div class="col-half col-right">
            <table>
                <tr><th>Location</th><td>{{ $scheme->district ?? 'Unknown' }}, {{ $scheme->municipality ?? 'N/A' }}</td></tr>
                <tr><th>Ward No.</th><td>{{ $scheme->ward_no ?? '-' }}</td></tr>
            </table>
        </div>
    </div>

    <div class="section-title">2. Participant Demographics</div>
    
    <table class="matrix-table" border="1" style="border-color: #e5e7eb;">
        <thead>
            <tr>
                <th style="text-align: left; width: 40%;">Category</th>
                <th>Female</th>
                <th>Male</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: left; font-weight: bold;">Dalit</td>
                <td>{{ $counts['dalit_female'] ?? 0 }}</td>
                <td>{{ $counts['dalit_male'] ?? 0 }}</td>
                <td style="background-color: #f3f4f6;">{{ ($counts['dalit_female'] ?? 0) + ($counts['dalit_male'] ?? 0) }}</td>
            </tr>
            <tr>
                <td style="text-align: left; font-weight: bold;">Janjati</td>
                <td>{{ $counts['janjati_female'] ?? 0 }}</td>
                <td>{{ $counts['janjati_male'] ?? 0 }}</td>
                <td style="background-color: #f3f4f6;">{{ ($counts['janjati_female'] ?? 0) + ($counts['janjati_male'] ?? 0) }}</td>
            </tr>
            <tr>
                <td style="text-align: left; font-weight: bold;">Others</td>
                <td>{{ $counts['other_female'] ?? 0 }}</td>
                <td>{{ $counts['other_male'] ?? 0 }}</td>
                <td style="background-color: #f3f4f6;">{{ ($counts['other_female'] ?? 0) + ($counts['other_male'] ?? 0) }}</td>
            </tr>
            <tr class="matrix-total">
                <td style="text-align: right; text-transform: uppercase;">Grand Total</td>
                <td>{{ ($counts['dalit_female']??0) + ($counts['janjati_female']??0) + ($counts['other_female']??0) }}</td>
                <td>{{ ($counts['dalit_male']??0) + ($counts['janjati_male']??0) + ($counts['other_male']??0) }}</td>
                <td style="font-size: 14px; background-color: #10b981; color: white;">{{ $total_participants }}</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">3. Scanned Evidence</div>
    
    @php
        $docs = $audit->audit_documents;
        // Filament stores multiple files as array or JSON
        if (is_string($docs)) $docs = json_decode($docs, true);
        if (!is_array($docs)) $docs = [];
    @endphp

    @if(empty($docs))
        <div style="text-align: center; color: #9ca3af; padding: 20px; border: 1px dashed #e5e7eb;">
            No documents attached.
        </div>
    @else
        <div class="image-container">
            @foreach($docs as $doc)
                @php
                    $extension = pathinfo($doc, PATHINFO_EXTENSION);
                @endphp

                @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'webp']))
                    <div style="margin-bottom: 10px;">
                        <img src="{{ $encodeImage($doc) }}" class="evidence-img">
                        <div style="font-size: 10px; color: #666;">File: {{ basename($doc) }}</div>
                    </div>
                @else
                    <div style="padding: 10px; border: 1px solid #e5e7eb; margin-bottom: 5px; text-align: left;">
                        <strong>[Document]</strong> {{ basename($doc) }} <br>
                        <span style="font-size: 9px; color: #666;">(This file type cannot be previewed in PDF report)</span>
                    </div>
                @endif
            @endforeach
        </div>
    @endif

    <div style="position: fixed; bottom: 0; width: 100%; text-align: center; color: #9ca3af; font-size: 10px; border-top: 1px solid #e5e7eb; padding-top: 10px;">
        © {{ date('Y') }} HELVETAS Nepal WSMIS | Generated via System
    </div>

</body>
</html>