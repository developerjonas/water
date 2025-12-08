<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Water Point Report - {{ $wp->water_point_name }}</title>
    <style>
        @page { margin: 30px 40px; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 13px;
            color: #374151;
            line-height: 1.5;
        }

        /* --- Headers --- */
        .header-container {
            text-align: center;
            border-bottom: 2px solid #10414b;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header-logo { height: 60px; margin-bottom: 5px; }
        h1 { color: #10414b; font-size: 20px; text-transform: uppercase; margin: 0; }
        .sub-title { font-size: 12px; color: #6b7280; }

        /* --- Section Titles --- */
        .section-header {
            background-color: #f3f4f6;
            border-left: 5px solid #10414b;
            color: #111827;
            padding: 6px 10px;
            font-size: 13px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        /* --- Tables --- */
        table { width: 100%; border-collapse: collapse; margin-bottom: 5px; }
        th, td { padding: 6px 8px; border-bottom: 1px solid #e5e7eb; vertical-align: top; }
        th { background-color: #ffffff; color: #4b5563; font-weight: bold; text-align: left; width: 35%; font-size: 11px; }
        td { color: #111827; font-weight: 500; font-size: 12px; }

        /* --- Badges --- */
        .badge {
            display: inline-block; padding: 2px 6px; border-radius: 4px; font-size: 10px; font-weight: bold;
        }
        .badge-success { background-color: #d1fae5; color: #065f46; } /* Green */
        .badge-danger  { background-color: #fee2e2; color: #991b1b; } /* Red */
        .badge-info    { background-color: #dbeafe; color: #1e40af; } /* Blue */
        .badge-warning { background-color: #fef3c7; color: #92400e; } /* Yellow */
        
        /* --- Grid Layout Helper --- */
        .row::after { content: ""; clear: both; display: table; }
        .col-half { float: left; width: 48%; }
        .right { float: right; }

        /* --- Footer --- */
        .footer {
            position: fixed; bottom: 0; left: 0; right: 0;
            text-align: center; font-size: 9px; color: #9ca3af;
            border-top: 1px solid #e5e7eb; padding-top: 8px;
        }
    </style>
</head>
<body>

    <div class="header-container">
        <img src="{{ public_path('images/logo.png') }}" class="header-logo" alt="Logo">
        <h1>Water Point Detail Report</h1>
        <div class="sub-title">Generated on {{ now()->format('d M Y') }}</div>
    </div>

    <div class="section-header">1. Water Point Identity</div>
    <div class="row">
        <div class="col-half">
            <table>
                <tr>
                    <th>Point / Owner Name</th>
                    <td style="font-size: 14px; font-weight: bold;">{{ $wp->water_point_name }}</td>
                </tr>
                <tr>
                    <th>Sub-System Name</th>
                    <td>{{ $wp->sub_system_name ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>
        <div class="col-half right">
            <table>
                <tr>
                    <th>Location Type</th>
                    <td><span class="badge badge-info">{{ $wp->location_type }}</span></td>
                </tr>
                <tr>
                    <th>Construction Status</th>
                    <td>
                        @php
                            $status = strtolower($wp->tap_construction_status);
                            $color = ($status === 'yes') ? 'badge-success' : 'badge-warning';
                            $label = ($status === 'yes') ? 'COMPLETED' : 'PENDING / NO';
                        @endphp
                        <span class="badge {{ $color }}">{{ $label }}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section-header">2. Parent Scheme Context</div>
    <table>
        <tr>
            <th>Linked Scheme Name</th>
            <td><strong>{{ $scheme->scheme_name ?? 'Unlinked' }}</strong></td>
        </tr>
        <tr>
            <th>System Code</th>
            <td>{{ $scheme->scheme_code ?? 'N/A' }}</td>
            <th>User Legacy Code</th>
            <td>{{ $scheme->scheme_code_user ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Scheme Location</th>
            <td colspan="3">
                {{ optional($scheme->districtRelation)->name ?? 'Unknown District' }}, 
                {{ optional($scheme->municipalityRelation)->name ?? 'Unknown Palika' }}
            </td>
        </tr>
    </table>

    <div class="section-header">3. Specific Location</div>
    <table>
        <tr>
            <th>Ward Number</th>
            <td>Ward No. {{ $wp->ward_no ?? 'N/A' }}</td>
            
            <th>Tole / Cluster</th>
            <td>{{ $wp->tole ?? 'N/A' }}</td>
        </tr>
        @if($wp->latitude && $wp->longitude)
        <tr>
            <th>GPS Coordinates</th>
            <td colspan="3">
                Lat: {{ $wp->latitude }}, Lon: {{ $wp->longitude }}
            </td>
        </tr>
        @endif
    </table>

    <div class="section-header">4. Socio-Economic Profile</div>
    <div class="row">
        <div class="col-half">
            <table>
                <tr>
                    <th>Households Served</th>
                    <td style="font-size:14px; font-weight:bold;">{{ $wp->households_count }} HHs</td>
                </tr>
                <tr>
                    <th>Ethnicity</th>
                    <td>{{ $wp->ethnicity ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>
        <div class="col-half right">
            <table>
                <tr>
                    <th>Economic Status</th>
                    <td>
                        @php
                            $ecoColor = match(strtolower($wp->economic_status)) {
                                'poor', 'ultra-poor' => 'badge-danger',
                                'non-poor' => 'badge-success',
                                default => 'badge-gray',
                            };
                        @endphp
                        <span class="badge {{ $ecoColor }}">{{ $wp->economic_status ?? 'Unknown' }}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section-header">5. Beneficiary Demographics</div>
    <table style="text-align: center;">
        <thead>
            <tr style="background-color: #f9fafb;">
                <th style="text-align: center;">Category</th>
                <th style="text-align: center;">Female</th>
                <th style="text-align: center;">Male</th>
                <th style="text-align: center; background-color: #f0fdf4; color: #065f46;">Total Users</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: left; font-weight: bold;">Count</td>
                <td>{{ $wp->woman }}</td>
                <td>{{ $wp->man }}</td>
                <td style="background-color: #f0fdf4; font-weight: bold; font-size: 14px;">
                    {{ $wp->total_water_users }}
                </td>
            </tr>
        </tbody>
    </table>

    @if($wp->remarks)
        <div class="section-header">6. Remarks</div>
        <div style="background: #fff; border: 1px solid #e5e7eb; padding: 10px; font-style: italic; color: #666;">
            "{{ $wp->remarks }}"
        </div>
    @endif

    <div class="footer">
        © {{ date('Y') }} HELVETAS Nepal WSMIS | Generated via System
    </div>

</body>
</html>