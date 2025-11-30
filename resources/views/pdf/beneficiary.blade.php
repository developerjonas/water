<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Beneficiary Report</title>
    <style>
        @page { margin: 30px 40px; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 13px;
            color: #374151;
            line-height: 1.5;
        }

        /* --- Header --- */
        .header-container {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #10414b;
            padding-bottom: 15px;
        }
        .header-logo { height: 60px; margin-bottom: 10px; }
        h1 { font-size: 22px; margin: 0; color: #10414b; text-transform: uppercase; }
        .meta-date { font-size: 10px; color: #6b7280; margin-top: 5px; }

        /* --- Sections --- */
        .section-header {
            background-color: #f3f4f6;
            border-left: 5px solid #10414b;
            color: #111827;
            padding: 6px 12px;
            font-size: 14px;
            font-weight: bold;
            margin-top: 25px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        /* --- Tables --- */
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { padding: 8px; border: 1px solid #e5e7eb; vertical-align: middle; text-align: center; }
        
        /* Table Headers */
        thead th { background-color: #f9fafb; color: #374151; font-weight: bold; font-size: 12px; }
        
        /* Row Headers (First Column) */
        tbody th { text-align: left; background-color: #fcfcfc; width: 30%; }
        
        /* Totals Row/Col */
        .total-row { background-color: #eff6ff; font-weight: bold; color: #1e40af; }
        .total-col { background-color: #eff6ff; font-weight: bold; }

        /* Scheme Info Table overrides */
        .info-table th { text-align: left; background-color: #fff; width: 20%; border: none; border-bottom: 1px solid #e5e7eb; }
        .info-table td { text-align: left; border: none; border-bottom: 1px solid #e5e7eb; }

        .badge { display: inline-block; padding: 2px 6px; border-radius: 4px; font-size: 11px; font-weight: bold; }
        .badge-gray { background-color: #f3f4f6; color: #374151; }

        .footer {
            position: fixed; bottom: 0; left: 0; right: 0;
            text-align: center; font-size: 10px; color: #9ca3af;
            border-top: 1px solid #e5e7eb; padding-top: 10px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header-container">
        <img src="{{ public_path('images/logo.png') }}" class="header-logo" alt="Logo">
        <h1>Beneficiary Report</h1>
        <div class="meta-date">Generated on {{ now()->format('d M Y, h:i A') }}</div>
    </div>

    <!-- 1. Scheme Association -->
    <div class="section-header">1. Associated Scheme</div>
    <table class="info-table">
        <tr>
            <th>Scheme Name</th>
            <td><strong>{{ $scheme->scheme_name ?? 'N/A' }}</strong></td>
            <th>Code</th>
            <td><span class="badge badge-gray">{{ $scheme->scheme_code ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <th>Location</th>
            <td colspan="3">
                {{ optional($scheme->province)->name }}, 
                {{ optional($scheme->district)->name }}, 
                {{ optional($scheme->municipality)->name }}
                @if($scheme->ward_no) - Ward {{ $scheme->ward_no }} @endif
            </td>
        </tr>
    </table>

    <!-- 2. Household Composition -->
    <div class="section-header">2. Household Composition (HH)</div>
    <table>
        <thead>
            <tr>
                <th style="text-align: left;">Caste / Ethnicity</th>
                <th>Poor HH</th>
                <th>Non-Poor HH</th>
                <th class="total-col">Total HH</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Dalit</th>
                <td>{{ $data->dalit_hh_poor }}</td>
                <td>{{ $data->dalit_hh_nonpoor }}</td>
                <td class="total-col">{{ $data->dalit_hh_poor + $data->dalit_hh_nonpoor }}</td>
            </tr>
            <tr>
                <th>Janajati (A/J)</th>
                <td>{{ $data->aj_hh_poor }}</td>
                <td>{{ $data->aj_hh_nonpoor }}</td>
                <td class="total-col">{{ $data->aj_hh_poor + $data->aj_hh_nonpoor }}</td>
            </tr>
            <tr>
                <th>Others</th>
                <td>{{ $data->other_hh_poor }}</td>
                <td>{{ $data->other_hh_nonpoor }}</td>
                <td class="total-col">{{ $data->other_hh_poor + $data->other_hh_nonpoor }}</td>
            </tr>
            <tr class="total-row">
                <td style="text-align: left;">Grand Total</td>
                <td>{{ $data->dalit_hh_poor + $data->aj_hh_poor + $data->other_hh_poor }}</td>
                <td>{{ $data->dalit_hh_nonpoor + $data->aj_hh_nonpoor + $data->other_hh_nonpoor }}</td>
                <td>
                    {{ 
                        ($data->dalit_hh_poor + $data->dalit_hh_nonpoor) + 
                        ($data->aj_hh_poor + $data->aj_hh_nonpoor) + 
                        ($data->other_hh_poor + $data->other_hh_nonpoor) 
                    }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- 3. Individual Population -->
    <div class="section-header">3. Population Details</div>
    <table>
        <thead>
            <tr>
                <th style="text-align: left;">Caste / Ethnicity</th>
                <th>Male</th>
                <th>Female</th>
                <th class="total-col">Total Population</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Dalit</th>
                <td>{{ $data->dalit_male }}</td>
                <td>{{ $data->dalit_female }}</td>
                <td class="total-col">{{ $data->dalit_male + $data->dalit_female }}</td>
            </tr>
            <tr>
                <th>Janajati (A/J)</th>
                <td>{{ $data->aj_male }}</td>
                <td>{{ $data->aj_female }}</td>
                <td class="total-col">{{ $data->aj_male + $data->aj_female }}</td>
            </tr>
            <tr>
                <th>Others</th>
                <td>{{ $data->others_male }}</td>
                <td>{{ $data->others_female }}</td>
                <td class="total-col">{{ $data->others_male + $data->others_female }}</td>
            </tr>
            <tr class="total-row">
                <td style="text-align: left;">Grand Total</td>
                <td>{{ $data->dalit_male + $data->aj_male + $data->others_male }}</td>
                <td>{{ $data->dalit_female + $data->aj_female + $data->others_female }}</td>
                <td>
                    {{ 
                        ($data->dalit_male + $data->dalit_female) + 
                        ($data->aj_male + $data->aj_female) + 
                        ($data->others_male + $data->others_female) 
                    }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- 4. Base Population Check -->
    <div style="margin-bottom: 20px; font-size: 12px; color: #555;">
        <strong>Reported Base Population:</strong> {{ $data->base_population }}
        @php
            $calculatedPop = ($data->dalit_male + $data->dalit_female) + 
                             ($data->aj_male + $data->aj_female) + 
                             ($data->others_male + $data->others_female);
        @endphp
        @if($data->base_population != $calculatedPop)
            <span style="color: #d97706; margin-left: 10px;">
                (Note: Differs from calculated sum of {{ $calculatedPop }})
            </span>
        @endif
    </div>

    <!-- 5. School Statistics -->
    <div class="section-header">4. School & Education</div>
    <table>
        <thead>
            <tr>
                <th style="text-align: left;">Metric</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Total Schools</th>
                <td>{{ $data->total_schools }}</td>
            </tr>
            <tr>
                <th>Boy Students</th>
                <td>{{ $data->boys_student }}</td>
            </tr>
            <tr>
                <th>Girl Students</th>
                <td>{{ $data->girls_student }}</td>
            </tr>
            <tr class="total-row">
                <th style="text-align: left; background-color: #eff6ff;">Total Students</th>
                <td>{{ $data->boys_student + $data->girls_student }}</td>
            </tr>
            <tr>
                <th>Teachers / Staff</th>
                <td>{{ $data->teachers_staff }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        © {{ date('Y') }} HELVETAS Nepal WSMIS | Water Scheme Management Information System
    </div>

</body>
</html>