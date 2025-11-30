<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Structure Detail Report</title>
    <style>
        @page { margin: 30px 40px; }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 13px;
            color: #374151;
            line-height: 1.5;
        }

        /* Header */
        .header-container {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #10414b;
            padding-bottom: 15px;
        }
        .header-logo { height: 60px; margin-bottom: 10px; }
        h1 { font-size: 22px; margin: 0; color: #10414b; text-transform: uppercase; }
        .meta-date { font-size: 10px; color: #6b7280; margin-top: 5px; }

        /* Section Headers */
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

        /* Tables */
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { padding: 8px; border: 1px solid #e5e7eb; vertical-align: middle; }
        th { background-color: #f9fafb; color: #374151; font-weight: bold; text-align: left; font-size: 12px; }
        
        /* Metric Columns */
        .col-metric { width: 40%; }
        .col-val { width: 30%; text-align: center; }

        .badge {
            display: inline-block; padding: 2px 6px; border-radius: 4px; font-size: 11px; font-weight: bold;
        }
        .badge-gray { background-color: #f3f4f6; color: #374151; }
        .badge-green { background-color: #d1fae5; color: #065f46; }

        /* Footer */
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
        <h1>Structure Detail Report</h1>
        <div class="meta-date">Generated on {{ now()->format('d M Y, h:i A') }}</div>
    </div>

    <!-- Scheme Context -->
    <div class="section-header">1. Associated Scheme</div>
    <table>
        <tr>
            <th width="20%">Scheme Name</th>
            <td><strong>{{ $scheme->scheme_name ?? 'N/A' }}</strong></td>
            <th width="20%">Scheme Code</th>
            <td><span class="badge badge-gray">{{ $scheme->scheme_code ?? 'N/A' }}</span></td>
        </tr>
        <tr>
            <th>Location</th>
            <td colspan="3">
                {{ optional($scheme->province)->name }}, 
                {{ optional($scheme->district)->name }}, 
                {{ optional($scheme->municipality)->name }} - Ward {{ $scheme->ward_no }}
            </td>
        </tr>
    </table>

    <!-- Source & Transmission -->
    <div class="section-header">2. Source & Transmission Structures</div>
    <table>
        <thead>
            <tr>
                <th class="col-metric">Component</th>
                <th class="col-val">Planned</th>
                <th class="col-val">Constructed</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Intakes</td>
                <td class="col-val">{{ $structure->intakes_planned }}</td>
                <td class="col-val">
                    <span class="badge {{ $structure->intakes_constructed > 0 ? 'badge-green' : 'badge-gray' }}">
                        {{ $structure->intakes_constructed }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>RVTs (Reservoir Tanks)</td>
                <td class="col-val">{{ $structure->rvts_planned }}</td>
                <td class="col-val">
                    <span class="badge {{ $structure->rvts_constructed > 0 ? 'badge-green' : 'badge-gray' }}">
                        {{ $structure->rvts_constructed }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>Transmission Line</td>
                <td class="col-val">{{ $structure->transmission_line_planned }}</td>
                <td class="col-val">
                    <span class="badge {{ $structure->transmission_line_constructed > 0 ? 'badge-green' : 'badge-gray' }}">
                        {{ $structure->transmission_line_constructed }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Storage & Distribution -->
    <div class="section-header">3. Storage & Distribution</div>
    <table>
        <thead>
            <tr>
                <th class="col-metric">Component</th>
                <th class="col-val">Planned</th>
                <th class="col-val">Constructed</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>CC / DC / BPT</td>
                <td class="col-val">{{ $structure->cc_dc_bpt_planned }}</td>
                <td class="col-val">
                    <span class="badge {{ $structure->cc_dc_bpt_constructed > 0 ? 'badge-green' : 'badge-gray' }}">
                        {{ $structure->cc_dc_bpt_constructed }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>Distribution Line</td>
                <td class="col-val">{{ $structure->distribution_line_planned }}</td>
                <td class="col-val">
                    <span class="badge {{ $structure->distribution_line_constructed > 0 ? 'badge-green' : 'badge-gray' }}">
                        {{ $structure->distribution_line_constructed }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>Other Structures</td>
                <td class="col-val">{{ $structure->other_structures_planned }}</td>
                <td class="col-val">
                    <span class="badge {{ $structure->other_structures_constructed > 0 ? 'badge-green' : 'badge-gray' }}">
                        {{ $structure->other_structures_constructed }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Taps & Connections -->
    <div class="section-header">4. Taps & Connections</div>
    <table>
        <thead>
            <tr>
                <th class="col-metric">Type</th>
                <th class="col-val">Planned</th>
                <th class="col-val">Constructed</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Public Taps</td>
                <td class="col-val">{{ $structure->public_taps_planned }}</td>
                <td class="col-val">
                    <span class="badge {{ $structure->public_taps_constructed > 0 ? 'badge-green' : 'badge-gray' }}">
                        {{ $structure->public_taps_constructed }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>School Taps</td>
                <td class="col-val">{{ $structure->school_taps_planned }}</td>
                <td class="col-val">
                    <span class="badge {{ $structure->school_taps_constructed > 0 ? 'badge-green' : 'badge-gray' }}">
                        {{ $structure->school_taps_constructed }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>Private Taps</td>
                <td class="col-val">{{ $structure->private_taps_planned }}</td>
                <td class="col-val">
                    <span class="badge {{ $structure->private_taps_constructed > 0 ? 'badge-green' : 'badge-gray' }}">
                        {{ $structure->private_taps_constructed }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>Private Lines</td>
                <td class="col-val">{{ $structure->private_line_planned }}</td>
                <td class="col-val">
                    <span class="badge {{ $structure->private_line_constructed > 0 ? 'badge-green' : 'badge-gray' }}">
                        {{ $structure->private_line_constructed }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Remarks -->
    @if($structure->remarks)
        <div class="section-header">5. Remarks</div>
        <div style="background: #fff; border: 1px solid #e5e7eb; padding: 10px; font-style: italic; color: #4b5563;">
            {{ $structure->remarks }}
        </div>
    @endif

    <div class="footer">
        © {{ date('Y') }} HELVETAS Nepal WSMIS | Water Scheme Management Information System
    </div>

</body>
</html>