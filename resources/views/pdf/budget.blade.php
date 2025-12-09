<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Budget Report - {{ $budget->id }}</title>
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
        th, td { padding: 10px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        th { background-color: #f9fafb; color: #4b5563; font-size: 11px; text-transform: uppercase; width: 40%; }
        td { font-weight: 500; }
        
        /* Financial Alignment */
        .money { text-align: right; font-family: monospace; font-size: 14px; }
        .total-row td { background-color: #f0fdf4; font-weight: bold; color: #065f46; border-top: 2px solid #059669; }

        /* Status Badge */
        .badge { 
            padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: bold; color: white; display: inline-block;
            text-transform: uppercase;
        }
        .bg-draft { background-color: #9ca3af; }
        .bg-approved { background-color: #10b981; }
        .bg-final { background-color: #3b82f6; }
        
        /* Grid Helper */
        .row::after { content: ""; clear: both; display: table; }
        .col-half { float: left; width: 48%; }
        .col-right { float: right; }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" class="logo" alt="Logo">
        <h1>Project Budget Estimate</h1>
        <div class="subtitle">Ref No: {{ $budget->budget_code ?? 'N/A' }} | Date: {{ now()->format('d M Y') }}</div>
    </div>

    <div class="section-title">1. Project Context</div>
    <div class="row">
        <div class="col-half">
            <table>
                <tr><th>Scheme Name</th><td>{{ $scheme->scheme_name ?? 'N/A' }}</td></tr>
                <tr><th>System Code</th><td>{{ $budget->scheme_code }}</td></tr>
            </table>
        </div>
        <div class="col-half col-right">
            <table>
                <tr><th>Budget Status</th>
                    <td>
                        @php
                            $status = strtolower($budget->budget_status);
                            $color = match($status) { 'approved' => 'bg-approved', 'final' => 'bg-final', default => 'bg-draft' };
                        @endphp
                        <span class="badge {{ $color }}">{{ $status }}</span>
                    </td>
                </tr>
                <tr><th>Location</th><td>{{ $scheme->district ?? 'Unknown' }}, {{ $scheme->municipality ?? 'N/A' }}</td></tr>
            </table>
        </div>
    </div>

    <div class="section-title">2. Financial Breakdown (NPR)</div>
    
    <div class="row">
        <div class="col-half">
            <h3 style="margin: 0 0 10px 0; font-size: 13px; color: #4b5563;">Helvetas Contribution</h3>
            <table>
                <tr>
                    <th>Cash</th>
                    <td class="money">{{ number_format($budget->helvetas_estimated_cash, 2) }}</td>
                </tr>
                <tr>
                    <th>Kind (Materials)</th>
                    <td class="money">{{ number_format($budget->helvetas_estimated_kind, 2) }}</td>
                </tr>
                <tr class="total-row" style="background-color: #eff6ff; color: #1e40af; border-top: 2px solid #3b82f6;">
                    <td>Subtotal</td>
                    <td class="money">{{ number_format($budget->helvetas_estimated_total, 2) }}</td>
                </tr>
            </table>
        </div>

        <div class="col-half col-right">
            <h3 style="margin: 0 0 10px 0; font-size: 13px; color: #4b5563;">Partner Contribution</h3>
            <table>
                <tr>
                    <th>Palika (Municipality)</th>
                    <td class="money">{{ number_format($budget->palika_estimated, 2) }}</td>
                </tr>
                <tr>
                    <th>Community</th>
                    <td class="money">{{ number_format($budget->community_contribution, 2) }}</td>
                </tr>
                <tr class="total-row" style="background-color: #fff7ed; color: #9a3412; border-top: 2px solid #f97316;">
                    <td>Subtotal</td>
                    <td class="money">{{ number_format($budget->palika_estimated + $budget->community_contribution, 2) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div style="margin-top: 20px; border: 2px solid #059669; padding: 15px; background-color: #f0fdf4; border-radius: 6px;">
        <table style="margin: 0;">
            <tr style="border: none;">
                <td style="font-size: 16px; font-weight: bold; color: #065f46; width: 60%;">GRAND TOTAL ESTIMATED BUDGET</td>
                <td class="money" style="font-size: 20px; font-weight: bold; color: #065f46;">
                    NPR {{ number_format($budget->total_estimated, 2) }}
                </td>
            </tr>
        </table>
    </div>

    @if($budget->remarks)
        <div class="section-title">3. Remarks</div>
        <div style="background: #fff; border: 1px solid #e5e7eb; padding: 15px; font-style: italic; color: #666;">
            "{{ $budget->remarks }}"
        </div>
    @endif

    <div style="position: fixed; bottom: 0; width: 100%; text-align: center; color: #9ca3af; font-size: 10px; border-top: 1px solid #e5e7eb; padding-top: 10px;">
        © {{ date('Y') }} HELVETAS Nepal WSMIS | Generated via System
    </div>

</body>
</html>