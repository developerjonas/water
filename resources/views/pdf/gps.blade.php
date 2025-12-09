<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>GPS Photo Report - {{ $photo->id }}</title>
    <style>
        @page { margin: 40px; }
        body { font-family: 'DejaVu Sans', sans-serif; color: #1f2937; font-size: 13px; line-height: 1.4; }
        
        /* Layout */
        .header { text-align: center; border-bottom: 3px solid #0891b2; padding-bottom: 20px; margin-bottom: 30px; }
        /* Important: Keep logo dimensions constrained */
        .logo { height: 60px; width: auto; margin-bottom: 10px; }
        h1 { color: #0891b2; font-size: 22px; text-transform: uppercase; margin: 0; }
        .subtitle { font-size: 11px; color: #6b7280; margin-top: 5px; }

        .section-title {
            background: #f3f4f6; border-left: 5px solid #0891b2; 
            padding: 8px 12px; font-weight: bold; font-size: 14px; 
            margin: 25px 0 15px 0; text-transform: uppercase;
        }

        /* Tables */
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 10px; border-bottom: 1px solid #e5e7eb; text-align: left; vertical-align: top; }
        th { background-color: #f9fafb; color: #4b5563; font-size: 11px; text-transform: uppercase; width: 35%; }
        td { font-weight: 500; }

        /* Images */
        /* Use table-like display to ensure side-by-side layout works in DomPDF */
        .image-grid { display: table; width: 100%; margin-top: 10px; border-spacing: 10px; }
        .image-row { display: table-row; }
        .image-box { 
            display: table-cell; width: 48%; vertical-align: top; margin-bottom: 20px;
            border: 1px solid #e5e7eb; padding: 5px; border-radius: 4px;
            page-break-inside: avoid; /* Try to keep image and label together */
        }
        /* Important: Ensure images don't blow out their containers */
        .image-box img { width: 100%; height: 200px; object-fit: cover; display: block; }
        .image-label { text-align: center; font-size: 11px; color: #6b7280; margin-top: 5px; font-weight: bold; }

        /* Badges */
        .badge { padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; background-color: #e5e7eb; color: #374151; display: inline-block; }
    </style>
</head>
<body>

    {{-- 
      HELPER: This PHP block defines a closure to handle image encoding.
      It tries to find the file, read it, and return a base64 data URI.
    --}}
    @php
        $encodeImage = function($path, $isStorage = true) {
            // Determine full path based on whether it's in storage or public dir
            $fullPath = $isStorage ? storage_path('app/public/' . $path) : public_path($path);

            if (!file_exists($fullPath)) {
                // Return a placeholder or empty string if file is missing
                return ''; 
            }

            try {
                $type = pathinfo($fullPath, PATHINFO_EXTENSION);
                $data = file_get_contents($fullPath);
                if ($data === false) throw new Exception("Cant read file");
                $base64 = base64_encode($data);
                return 'data:image/' . $type . ';base64,' . $base64;
            } catch (\Exception $e) {
                 // Handle permission errors silently in PDF
                return '';
            }
        };
    @endphp

    <div class="header">
        {{-- Use helper for public logo (second arg false) --}}
        <img src="{{ $encodeImage('images/logo.png', false) }}" class="logo" alt="Logo">
        <h1>GPS Photo Evidence Report</h1>
        <div class="subtitle">Reference ID: #{{ $photo->id }} | Generated: {{ now()->format('d M Y') }}</div>
    </div>

    <div class="section-title">1. Scheme Context</div>
    <table>
        <tr>
            <th>Scheme Name</th>
            <td>{{ $scheme->scheme_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>System Code</th>
            <td>{{ $photo->scheme_code }}</td>
        </tr>
        <tr>
            <th>Location</th>
            <td>
                {{ $scheme->district ?? 'Unknown District' }}, 
                {{ $scheme->municipality ?? 'Unknown Palika' }}
            </td>
        </tr>
    </table>

    <div class="section-title">2. System Configuration</div>
    <table>
        <tr>
            <th>Water System Name</th>
            <td style="font-weight: bold;">{{ $photo->water_system_name }}</td>
        </tr>
        <tr>
            <th>Location Type</th>
            <td><span class="badge">{{ $photo->location_type }}</span></td>
        </tr>
        <tr>
            <th>Source Type</th>
            <td><span class="badge">{{ $photo->source_type }}</span></td>
        </tr>
        <tr>
            <th>Hardware Type</th>
            <td><span class="badge">{{ $photo->hardware_type }}</span></td>
        </tr>
    </table>

    <div class="section-title">3. Geolocation Data</div>
    <table>
        <tr>
            <th>Latitude</th>
            <td>{{ $photo->latitude ?? 'Not Recorded' }}</td>
            <th>Longitude</th>
            <td>{{ $photo->longitude ?? 'Not Recorded' }}</td>
        </tr>
    </table>

    <div class="section-title">4. Visual Evidence</div>
    
    <div class="image-grid">
        <div class="image-row">
        @if($photo->structure_photos)
            @php
                $structPhotos = is_array($photo->structure_photos) ? $photo->structure_photos : [$photo->structure_photos];
            @endphp
            @foreach($structPhotos as $path)
                <div class="image-box">
                    {{-- Use helper for storage image (second arg true default) --}}
                    <img src="{{ $encodeImage($path) }}" alt="Structure Photo">
                    <div class="image-label">Structure Evidence</div>
                </div>
            @endforeach
        @endif

        @if($photo->plaque_photos)
            @php
                $plaquePhotos = is_array($photo->plaque_photos) ? $photo->plaque_photos : [$photo->plaque_photos];
            @endphp
            @foreach($plaquePhotos as $path)
                <div class="image-box">
                     {{-- Use helper for storage image --}}
                    <img src="{{ $encodeImage($path) }}" alt="Plaque Photo">
                    <div class="image-label">Plaque / Signage</div>
                </div>
            @endforeach
        @endif
        </div>

        @if(empty($photo->structure_photos) && empty($photo->plaque_photos))
            <div style="text-align: center; color: #9ca3af; padding: 20px; border: 1px dashed #e5e7eb; display: block; width: 100%;">
                No visual evidence uploaded.
            </div>
        @endif
    </div>

    @if($photo->remarks)
        <div class="section-title">5. Notes</div>
        <div style="background: #fff; border: 1px solid #e5e7eb; padding: 15px; font-style: italic;">
            "{{ $photo->remarks }}"
        </div>
    @endif

    <div style="position: fixed; bottom: 0; width: 100%; text-align: center; color: #9ca3af; font-size: 10px; border-top: 1px solid #e5e7eb; padding-top: 10px;">
        © {{ date('Y') }} HELVETAS Nepal WSMIS | Generated via System
    </div>

</body>
</html>