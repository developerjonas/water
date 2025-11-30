<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Scheme Report - {{ $scheme->scheme_code }}</title>
    <style>
        @page {
            margin: 30px 40px;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif; /* Standard for DomPDF */
            font-size: 13px;
            color: #374151; /* Gray-700 */
            line-height: 1.5;
        }

        /* --- Layout & Typography --- */
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
            color: #10414b; /* Brand Dark Teal */
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
            color: #4b5563; /* Gray-600 */
            font-weight: bold;
            text-align: left;
            width: 30%;
            font-size: 12px;
        }

        td {
            color: #111827; /* Gray-900 */
            font-weight: 500;
        }

        /* --- Specific Styles --- */
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
        }
        
        .badge-success { background-color: #d1fae5; color: #065f46; }
        .badge-warning { background-color: #fef3c7; color: #92400e; }
        .badge-gray    { background-color: #f3f4f6; color: #374151; }
        .badge-blue    { background-color: #dbeafe; color: #1e40af; }

        .two-col-container {
            width: 100%;
            margin-bottom: 15px;
        }
        
        .col-left {
            float: left;
            width: 48%;
        }
        
        .col-right {
            float: right;
            width: 48%;
        }

        /* Clearfix */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
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

    <!-- Header -->
    <div class="header-container">
        <!-- Replace with actual logo path logic -->
        <img src="{{ public_path('images/logo.png') }}" class="header-logo" alt="Logo">
        <h1>Scheme Detail Report</h1>
        <div class="meta-date">Generated on {{ now()->format('d M Y, h:i A') }}</div>
    </div>

    <!-- Section 1: Overview & Codes -->
    <div class="section-header">1. Scheme Identity</div>
    <div class="two-col-container clearfix">
        <div class="col-left">
            <table>
                <tr>
                    <th>System Code</th>
                    <td>
                        <span class="badge badge-gray">{{ $scheme->scheme_code }}</span>
                    </td>
                </tr>
                <tr>
                    <th>User Ref Code</th>
                    <td>{{ $scheme->scheme_code_user ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Scheme Name</th>
                    <td>
                        <strong>{{ $scheme->scheme_name }}</strong>
                        @if($scheme->scheme_name_np)
                            <br><span style="font-family: sans-serif; font-size: 11px; color: #666;">{{ $scheme->scheme_name_np }}</span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-right">
            <table>
                <tr>
                    <th>Collaborator</th>
                    <td>{{ $scheme->collaborator ?? 'None' }}</td>
                </tr>
                <tr>
                    <th>Start Fiscal Year</th>
                    <td>{{ $scheme->scheme_start_year }}</td>
                </tr>
                <tr>
                    <th>Current Status</th>
                    <td>
                        @php
                            $statusColor = match($scheme->progress_status) {
                                'Completed' => 'badge-success',
                                'Ongoing' => 'badge-warning',
                                default => 'badge-gray',
                            };
                        @endphp
                        <span class="badge {{ $statusColor }}">{{ $scheme->progress_status }}</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Section 2: Geographic Location -->
    <div class="section-header">2. Geographic Location</div>
    <table>
        <tr>
            <!-- Using object access for relations, assuming relationships are loaded -->
            <th>Province</th>
            <td>{{ optional($scheme->province)->name ?? $scheme->province_id ?? 'N/A' }}</td>
            
            <th>District</th>
            <td>{{ optional($scheme->district)->name ?? $scheme->district_id ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Municipality</th>
            <td>{{ optional($scheme->municipality)->name ?? $scheme->mun ?? 'N/A' }}</td>
            
            <th>Ward Number</th>
            <td><span class="badge badge-blue">Ward No. {{ $scheme->ward_no }}</span></td>
        </tr>
    </table>

    <!-- Section 3: Technical Classification -->
    <div class="section-header">3. Technical Specifications</div>
    <div class="two-col-container clearfix">
        <div class="col-left">
            <table>
                <tr>
                    <th>Broad Sector</th>
                    <td>{{ $scheme->sector }}</td>
                </tr>
                <tr>
                    <th>Scheme Type</th>
                    <td>{{ $scheme->scheme_type }}</td>
                </tr>
                <tr>
                    <th>Technology</th>
                    <td>{{ $scheme->scheme_technology }}</td>
                </tr>
            </table>
        </div>
        <div class="col-right">
            <table>
                <tr>
                    <th>Construction Type</th>
                    <td>{{ $scheme->scheme_construction_type }}</td>
                </tr>
                <tr>
                    <th>No. of Sub-schemes</th>
                    <td>{{ $scheme->no_of_subschemes ?? '0' }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Section 4: Indicators (Booleans) -->
    <div class="section-header">4. Status Indicators</div>
    <table>
        <tr>
            <th>Source Registered</th>
            <td>
                <span style="color: {{ $scheme->source_registration_status ? '#059669' : '#9ca3af' }}">
                    {{ $scheme->source_registration_status ? '✔ Yes' : '✘ No' }}
                </span>
            </td>
            
            <th>Source Conservation</th>
            <td>
                <span style="color: {{ $scheme->source_conservation ? '#059669' : '#9ca3af' }}">
                    {{ $scheme->source_conservation ? '✔ Yes' : '✘ No' }}
                </span>
            </td>

            <th>Standalone Scheme</th>
            <td>
                <span style="color: {{ $scheme->no_subscheme ? '#2563eb' : '#9ca3af' }}">
                    {{ $scheme->no_subscheme ? '✔ Yes' : '✘ No' }}
                </span>
            </td>
        </tr>
    </table>

    <!-- Section 5: Timeline -->
    <div class="section-header">5. Project Timeline</div>
    <table>
        <tr>
            <th>Agreement Signed</th>
            <td>{{ optional($scheme->agreement_signed_date)->format('d M Y') }}</td>
            
            <th>Work Started</th>
            <td>{{ optional($scheme->started_date)->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>Scheduled End</th>
            <td>{{ optional($scheme->schedule_end_date)->format('d M Y') }}</td>
            
            <th>Planned Completion</th>
            <td>{{ optional($scheme->planned_completion_date)->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>Actual Completed</th>
            <td>{{ optional($scheme->actual_completed_date)->format('d M Y') }}</td>
            
            <th>Final Report Date</th>
            <td style="color: #059669; font-weight: bold;">
                {{ optional($scheme->completion_date)->format('d M Y') }}
            </td>
        </tr>
    </table>

    <!-- Justification Block -->
    @if($scheme->justification_for_delay)
        <div style="margin-top: 20px; background: #fff; border: 1px solid #e5e7eb; padding: 15px; border-radius: 4px;">
            <div style="font-weight: bold; color: #dc2626; margin-bottom: 5px; font-size: 11px; text-transform: uppercase;">
                Justification for Delay
            </div>
            <div style="color: #4b5563; font-style: italic;">
                "{{ $scheme->justification_for_delay }}"
            </div>
        </div>
    @endif

    <div class="footer">
        © {{ date('Y') }} HELVETAS Nepal WSMIS | Water Scheme Management Information System
    </div>

</body>
</html>