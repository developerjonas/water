<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Water Quality Report - {{ $test->id }}</title>
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
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        th { background-color: #f9fafb; color: #4b5563; font-size: 11px; text-transform: uppercase; width: 30%; }
        td { font-weight: 500; }

        /* Status Badges */
        .badge { padding: 3px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; color: white; display: inline-block; }
        .bg-success { background-color: #10b981; } /* Green */
        .bg-warning { background-color: #f59e0b; } /* Orange */
        .bg-danger  { background-color: #ef4444; } /* Red */
        .bg-info    { background-color: #3b82f6; } /* Blue */

        /* --- DATA VISUALIZATION: RISK METER --- */
        .risk-container { margin-bottom: 20px; page-break-inside: avoid; }
        .risk-label { font-size: 11px; font-weight: bold; margin-bottom: 5px; display: block; }
        
        .meter-bar {
            height: 15px; width: 100%; position: relative;
            background: linear-gradient(to right, #10b981 0%, #10b981 10%, #f59e0b 20%, #ef4444 80%);
            border-radius: 8px; overflow: hidden; border: 1px solid #e5e7eb;
        }
        
        .meter-marker {
            position: absolute; top: -3px; width: 4px; height: 21px; background: #000;
            border: 1px solid #fff; box-shadow: 0 0 2px rgba(0,0,0,0.5);
        }
        
        .meter-legend {
            display: flex; justify-content: space-between; font-size: 9px; color: #6b7280; margin-top: 4px;
        }
        
        /* Grid Helper */
        .row::after { content: ""; clear: both; display: table; }
        .col-half { float: left; width: 48%; }
        .col-right { float: right; }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">
        <h1>Water Quality Analysis Report</h1>
        <div class="subtitle">Report Reference: #{{ $test->id }} | Date Generated: {{ now()->format('d M Y') }}</div>
    </div>

    <div class="section-title">1. Test Context</div>
    <div class="row">
        <div class="col-half">
            <table>
                <tr><th>Scheme Name</th><td>{{ $scheme->scheme_name ?? 'N/A' }}</td></tr>
                <tr><th>System Code</th><td>{{ $test->scheme_code }}</td></tr>
            </table>
        </div>
        <div class="col-half col-right">
            <table>
                <tr><th>Sample Point</th><td><strong>{{ $test->tested_point_name }}</strong></td></tr>
                <tr><th>Test Date</th><td>{{ $test->test_date?->format('d M Y') ?? 'N/A' }}</td></tr>
            </table>
        </div>
    </div>

    <div class="section-title">2. Microbiological Analysis</div>
    
    <table style="margin-bottom: 20px;">
        <thead>
            <tr>
                <th>Parameter</th>
                <th>Result (CFU/100ml)</th>
                <th>Risk Category</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>E. coli</strong></td>
                <td style="font-size: 14px;">{{ $test->ecoli }}</td>
                <td>
                    <span class="badge bg-{{ $test->ecoli_color }}">
                        {{ $test->ecoli_risk }}
                    </span>
                </td>
            </tr>
            <tr>
                <td><strong>Total Coliform</strong></td>
                <td style="font-size: 14px;">{{ $test->coliform }}</td>
                <td>
                    <span class="badge bg-{{ match(true) { $test->coliform == 0 => 'success', $test->coliform <= 10 => 'info', default => 'danger' } }}">
                        {{ $test->coliform_risk }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="risk-container">
        <span class="risk-label">Analysis: E.coli Contamination Scale</span>
        <div class="meter-bar">
            {{-- Calculate percentage position based on logarithmic scale for better visuals --}}
            @php
                $val = $test->ecoli;
                $percent = 0;
                if($val == 0) $percent = 5;       // Safe Zone
                elseif($val <= 10) $percent = 25; // Low Risk
                elseif($val <= 100) $percent = 60;// Medium
                else $percent = 90;               // High
            @endphp
            <div class="meter-marker" style="left: {{ $percent }}%;"></div>
        </div>
        <div class="meter-legend" style="width: 100%; position: relative; height: 15px;">
            <span style="position: absolute; left: 0;">Safe (0)</span>
            <span style="position: absolute; left: 25%;">Low (1-10)</span>
            <span style="position: absolute; left: 60%;">Intermediate (11-100)</span>
            <span style="position: absolute; right: 0;">High (>100)</span>
        </div>
    </div>

    <div class="section-title">3. Physical & Chemical Parameters</div>
    <table>
        <thead>
            <tr>
                <th>Parameter</th>
                <th>Result</th>
                <th>Standard</th>
                <th>Compliance Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>pH Value</strong></td>
                <td>{{ $test->ph }}</td>
                <td>6.5 - 8.5</td>
                <td>
                    @if($test->ph_status === 'Compliant')
                        <span class="badge bg-success">✔ Compliant</span>
                    @else
                        <span class="badge bg-danger">✘ Non-Compliant</span>
                    @endif
                </td>
            </tr>
            
            <tr>
                <td><strong>Turbidity</strong></td>
                <td>{{ $test->turbidity }} NTU</td>
                <td>&lt; 5 NTU</td>
                <td>
                    @if($test->turbidity_status === 'Compliant')
                        <span class="badge bg-success">✔ Compliant</span>
                    @else
                        <span class="badge bg-danger">✘ High Turbidity</span>
                    @endif
                </td>
            </tr>

            <tr>
                <td><strong>Free Residual Chlorine</strong></td>
                <td>{{ $test->frc }} mg/L</td>
                <td>0.1 - 0.5 mg/L</td>
                <td>
                    @if($test->frc_status === 'Adequate')
                        <span class="badge bg-success">✔ Adequate</span>
                    @else
                        <span class="badge bg-warning">⚠ Low/None</span>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    @if($test->remarks)
        <div class="section-title">4. Observations</div>
        <div style="background: #fff; border: 1px solid #e5e7eb; padding: 15px; font-style: italic;">
            "{{ $test->remarks }}"
        </div>
    @endif

    <div style="position: fixed; bottom: 0; width: 100%; text-align: center; color: #9ca3af; font-size: 10px; border-top: 1px solid #e5e7eb; padding-top: 10px;">
        © {{ date('Y') }} HELVETAS Nepal WSMIS | Automatically Generated Report
    </div>

</body>
</html>