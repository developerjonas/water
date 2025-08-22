<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scheme Report</title>
    <style>
        @page { margin: 40px; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; color: #333; }
        header { text-align: center; margin-bottom: 20px; }
        header img { height: 60px; }
        header h1 { font-size: 24px; margin: 10px 0 0; color: #2c3e50; }
        .section-title {
            background: #2c3e50;
            color: #fff;
            padding: 6px 12px;
            font-size: 16px;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th { background: #f4f4f4; width: 35%; }
        .status { font-weight: bold; color: #16a085; }
        footer {
            text-align: center;
            font-size: 12px;
            margin-top: 30px;
            color: #888;
        }
    </style>
</head>
<body>

<header>
    <img src="{{ public_path('images/logo.png') }}" alt="Logo">
    <h1>Water Scheme Report</h1>
</header>

<!-- Basic Details -->
<div class="section-title">Basic Information</div>
<table>
    <tr>
        <th>Scheme Code</th>
        <td>{{ $scheme->scheme_code }}</td>
    </tr>
    <tr>
        <th>Scheme Name (EN)</th>
        <td>{{ $scheme->scheme_name }}</td>
    </tr>
    @if($scheme->scheme_name_np)
    <tr>
        <th>Scheme Name (NP)</th>
        <td>{{ $scheme->scheme_name_np }}</td>
    </tr>
    @endif
</table>

<!-- Location Details -->
<div class="section-title">Location Details</div>
<table>
    <tr>
        <th>Province</th>
        <td>{{ $scheme->province }}</td>
    </tr>
    <tr>
        <th>District</th>
        <td>{{ $scheme->district }}</td>
    </tr>
    <tr>
        <th>Municipality</th>
        <td>{{ $scheme->mun }}</td>
    </tr>
    <tr>
        <th>Ward No.</th>
        <td>{{ $scheme->ward_no }}</td>
    </tr>
</table>

<!-- Type & Technology -->
<div class="section-title">Type & Technology</div>
<table>
    <tr>
        <th>Sector</th>
        <td>{{ $scheme->sector }}</td>
    </tr>
    <tr>
        <th>Technology</th>
        <td>{{ $scheme->scheme_technology }}</td>
    </tr>
    <tr>
        <th>Scheme Type</th>
        <td>{{ $scheme->scheme_type }}</td>
    </tr>
    <tr>
        <th>Construction Type</th>
        <td>{{ $scheme->scheme_construction_type }}</td>
    </tr>
</table>

<!-- Timeline -->
<div class="section-title">Timeline</div>
<table>
    <tr>
        <th>Start Year</th>
        <td>{{ $scheme->scheme_start_year }}</td>
    </tr>
    <tr>
        <th>Agreement Signed</th>
        <td>{{ optional($scheme->agreement_signed_date)->format('d M Y') }}</td>
    </tr>
    <tr>
        <th>Started Date</th>
        <td>{{ optional($scheme->started_date)->format('d M Y') }}</td>
    </tr>
    <tr>
        <th>Planned Completion</th>
        <td>{{ optional($scheme->planned_completion_date)->format('d M Y') }}</td>
    </tr>
    <tr>
        <th>Actual Completed</th>
        <td>{{ optional($scheme->actual_completed_date)->format('d M Y') }}</td>
    </tr>
</table>

<!-- Status -->
<div class="section-title">Status & Flags</div>
<table>
    <tr>
        <th>Source Registered</th>
        <td class="status">{{ $scheme->source_registration_status ? 'Yes' : 'No' }}</td>
    </tr>
    <tr>
        <th>Source Conservation</th>
        <td class="status">{{ $scheme->source_conservation ? 'Yes' : 'No' }}</td>
    </tr>
    <tr>
        <th>No Subscheme</th>
        <td class="status">{{ $scheme->no_subscheme ? 'Yes' : 'No' }}</td>
    </tr>
    <tr>
        <th>Progress Status</th>
        <td>{{ $scheme->progress_status ?? 'N/A' }}</td>
    </tr>
    @if($scheme->justification_for_delay)
    <tr>
        <th>Justification for Delay</th>
        <td>{{ $scheme->justification_for_delay }}</td>
    </tr>
    @endif
</table>

<footer>
    Generated on {{ now()->format('d M Y, h:i A') }}  
    | © Your Organization
</footer>

</body>
</html>
