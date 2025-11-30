<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>GPS Report - {{ $record->water_system_name }}</title>
    <style>
        @page {
            margin: 30px 40px;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 13px;
            color: #374151;
            line-height: 1.5;
        }

        /* --- Layout & Typography (Matches Scheme Report) --- */
        .header-container {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #10414b;
            padding-bottom: 15px;
        }

        .header-logo {
            height: 60px;
            margin-bottom: 10px;
        }

        h1 {
            font-size: 24px;
            margin: 0;
            color: #10414b;
            text-transform: uppercase;
        }

        .meta-date {
            font-size: 10px;
            color: #6b7280;
            margin-top: 5px;
        }

        .section-header {
            background-color: #f3f4f6;
            border-left: 5px solid #10414b;
            color: #111827;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* --- Tables --- */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }

        th, td {
            padding: 8px 10px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        th {
            background-color: #ffffff;
            color: #4b5563;
            font-weight: bold;
            text-align: left;
            width: 30%;
            font-size: 12px;
        }

        td {
            color: #111827;
            font-weight: 500;
        }

        /* --- Badges --- */
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
        }
        
        .badge-info    { background-color: #dbeafe; color: #1e40af; } /* Blue */
        .badge-success { background-color: #d1fae5; color: #065f46; } /* Green */
        .badge-warning { background-color: #fef3c7; color: #92400e; } /* Orange */
        .badge-gray    { background-color: #f3f4f6; color: #374151; }

        /* --- Photo Gallery Grid --- */
        .photo-grid {
            width: 100%;
            margin-bottom: 20px;
        }
        .photo-cell {
            width: 48%; /* 2 photos per row */
            padding: 5px;
            display: inline-block;
            vertical-align: top;
            margin-bottom: 15px;
        }
        .photo-frame {
            border: 1px solid #e5e7eb;
            padding: 5px;
            background: #fff;
        }
        .photo-img {
            width: 100%;
            height: 200px; /* Fixed height for consistency */
            object-fit: cover;
        }
        .photo-caption {
            font-size: 10px;
            color: #6b7280;
            text-align: center;
            margin-top: 5px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <div class="header-container">
        <img src="{{ public_path('images/logo.png') }}" class="header-logo" alt="Logo">
        <h1>Water System GPS Report</h1>
        <div class="meta-date">Generated on {{ now()->format('d M Y, h:i A') }}</div>
    </div>

    <div class="section-header">1. System Configuration</div>
    <table>
        <tr>
            <th>Scheme Code</th>
            <td><span class="badge badge-gray">{{ $record->scheme_code }}</span></td>
            
            <th>Scheme Name</th>
            <td>{{ $record->scheme?->name ?? $record->scheme_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Water System Name</th>
            <td colspan="3"><strong>{{ $record->water_system_name }}</strong></td>
        </tr>
    </table>
    
    <table style="margin-top: 10px;">
        <tr>
            <th>Location Type</th>
            <td><span class="badge badge-info">{{ $record->location_type }}</span></td>
        </tr>
        <tr>
            <th>Source Type</th>
            <td><span class="badge badge-success">{{ $record->source_type }}</span></td>
        </tr>
        <tr>
            <th>Hardware Type</th>
            <td><span class="badge badge-warning">{{ $record->hardware_type }}</span></td>
        </tr>
    </table>

    <div class="section-header">2. Geolocation</div>
    <table>
        <tr>
            <th>Latitude</th>
            <td>{{ $record->latitude }}</td>
            
            <th>Longitude</th>
            <td>{{ $record->longitude }}</td>
        </tr>
        <tr>
            <th>Google Maps</th>
            <td colspan="3">
                <a href="https://maps.google.com/?q={{ $record->latitude }},{{ $record->longitude }}" target="_blank" style="color: #2563eb; text-decoration: none;">
                    View on Map ({{ $record->latitude }}, {{ $record->longitude }})
                </a>
            </td>
        </tr>
    </table>

    <div class="section-header">3. Visual Evidence</div>

    {{-- Helper logic to ensure arrays --}}
    @php
        $structurePhotos = $record->structure_photos ?? [];
        if (is_string($structurePhotos)) $structurePhotos = json_decode($structurePhotos, true);

        $plaquePhotos = $record->plaque_photos ?? [];
        if (is_string($plaquePhotos)) $plaquePhotos = json_decode($plaquePhotos, true);
    @endphp

    @if(!empty($structurePhotos))
        <div style="margin-bottom: 10px; font-weight: bold; color: #4b5563; border-bottom: 1px dashed #e5e7eb; padding-bottom: 5px;">
            A. Structure Photos
        </div>
        <div class="photo-grid">
            @foreach($structurePhotos as $photo)
                <div class="photo-cell">
                    <div class="photo-frame">
                        <img src="{{ public_path('storage/' . $photo) }}" class="photo-img">
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if(!empty($plaquePhotos))
        <div style="margin-bottom: 10px; font-weight: bold; color: #4b5563; border-bottom: 1px dashed #e5e7eb; padding-bottom: 5px; margin-top: 10px;">
            B. Plaque Photos
        </div>
        <div class="photo-grid">
            @foreach($plaquePhotos as $photo)
                <div class="photo-cell">
                    <div class="photo-frame">
                        <img src="{{ public_path('storage/' . $photo) }}" class="photo-img">
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if(empty($structurePhotos) && empty($plaquePhotos))
        <div style="padding: 20px; text-align: center; color: #9ca3af; font-style: italic; border: 1px dashed #e5e7eb;">
            No photos uploaded for this system.
        </div>
    @endif

    @if($record->remarks)
        <div class="section-header">4. Additional Notes</div>
        <div style="background: #fff; border: 1px solid #e5e7eb; padding: 15px; border-radius: 4px;">
            <div style="color: #4b5563; font-style: italic;">
                "{{ $record->remarks }}"
            </div>
        </div>
    @endif

    <div class="footer">
        © {{ date('Y') }} HELVETAS Nepal WSMIS | Water Scheme Management Information System
    </div>

</body>
</html>