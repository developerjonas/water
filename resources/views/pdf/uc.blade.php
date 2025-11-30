<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>User Committee Report</title>
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
            margin-top: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        /* Tables */
        table { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        th, td { padding: 8px; border: 1px solid #e5e7eb; vertical-align: middle; }
        th { background-color: #f9fafb; color: #374151; font-weight: bold; text-align: left; font-size: 12px; }
        
        /* Specific Column Widths */
        .col-label { width: 30%; background-color: #f9fafb; font-weight: bold; }
        .col-val { width: 70%; }
        
        /* Badges */
        .badge {
            display: inline-block; padding: 2px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; text-transform: uppercase;
        }
        .badge-gray { background-color: #f3f4f6; color: #374151; }
        .badge-green { background-color: #d1fae5; color: #065f46; }
        .badge-blue { background-color: #dbeafe; color: #1e40af; }

        /* Footer */
        .footer {
            position: fixed; bottom: 0; left: 0; right: 0;
            text-align: center; font-size: 10px; color: #9ca3af;
            border-top: 1px solid #e5e7eb; padding-top: 10px;
        }
        
        /* Utilities */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

    <div class="header-container">
        <img src="{{ public_path('images/logo.png') }}" class="header-logo" alt="Logo">
        <h1>User Committee Report</h1>
        <div class="meta-date">Generated on {{ now()->format('d M Y, h:i A') }}</div>
    </div>

    <div class="section-header">1. Scheme Association</div>
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

    <div class="section-header">2. Committee Details & Status</div>
    <table>
        <tr>
            <td class="col-label">Committee Name</td>
            <td class="col-val"><strong>{{ $committee->user_committee_name }}</strong></td>
        </tr>
        <tr>
            <td class="col-label">Formation Date</td>
            <td class="col-val">{{ $committee->date_of_formation ? \Carbon\Carbon::parse($committee->date_of_formation)->format('d M Y') : '-' }}</td>
        </tr>
        <tr>
            <td class="col-label">Registration Status</td>
            <td class="col-val">
                <span class="badge badge-blue">{{ str_replace('_', ' ', $committee->registration_status) }}</span>
                @if($committee->registration_number)
                    (Reg No: {{ $committee->registration_number }})
                @endif
            </td>
        </tr>
        <tr>
            <td class="col-label">Contract Period</td>
            <td class="col-val">
                From: {{ $committee->contract_date ? \Carbon\Carbon::parse($committee->contract_date)->format('d M Y') : 'N/A' }} 
                To: {{ $committee->contract_expiry_date ? \Carbon\Carbon::parse($committee->contract_expiry_date)->format('d M Y') : 'N/A' }}
            </td>
        </tr>
    </table>

    <div class="section-header">3. Banking Information</div>
    <table>
        <thead>
            <tr>
                <th>Bank Name</th>
                <th>Account Name</th>
                <th>Account Number</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $committee->user_committee_bank_name ?? '-' }}</td>
                <td>{{ $committee->user_committee_bank_account_name ?? '-' }}</td>
                <td><strong>{{ $committee->user_committee_bank_account_number ?? '-' }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="section-header">4. Executive Body (Key Positions)</div>
    <table>
        <thead>
            <tr>
                <th width="30%">Position</th>
                <th width="40%">Name</th>
                <th width="30%">Contact</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Chairperson</td>
                <td>{{ $committee->chair_name }}</td>
                <td>{{ $committee->chair_contact }}</td>
            </tr>
            <tr>
                <td>Vice-Chairperson</td>
                <td>{{ $committee->vice_chair_name }}</td>
                <td>{{ $committee->vice_chair_contact }}</td>
            </tr>
            <tr>
                <td>Secretary</td>
                <td>{{ $committee->secretary_name }}</td>
                <td>{{ $committee->secretary_contact }}</td>
            </tr>
            <tr>
                <td>Deputy Secretary</td>
                <td>{{ $committee->deputy_secretary_name }}</td>
                <td>{{ $committee->deputy_secretary_contact }}</td>
            </tr>
            <tr>
                <td>Treasurer</td>
                <td>{{ $committee->treasurer_name }}</td>
                <td>{{ $committee->treasurer_contact }}</td>
            </tr>
        </tbody>
    </table>

    <div class="section-header">5. Committee Composition</div>
    <table>
        <thead>
            <tr>
                <th rowspan="2" style="vertical-align: bottom;">Ethnicity / Group</th>
                <th colspan="2" class="text-center">Key Positions</th>
                <th colspan="2" class="text-center">Members</th>
                <th rowspan="2" class="text-center" style="vertical-align: bottom;">Total</th>
            </tr>
            <tr>
                <th class="text-center" style="font-size: 11px;">Female</th>
                <th class="text-center" style="font-size: 11px;">Male</th>
                <th class="text-center" style="font-size: 11px;">Female</th>
                <th class="text-center" style="font-size: 11px;">Male</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Dalit</strong></td>
                <td class="text-center">{{ $committee->dalit_female_key }}</td>
                <td class="text-center">{{ $committee->dalit_male_key }}</td>
                <td class="text-center">{{ $committee->dalit_female_member }}</td>
                <td class="text-center">{{ $committee->dalit_male_member }}</td>
                <td class="text-center">
                    <strong>{{ $committee->dalit_female_key + $committee->dalit_male_key + $committee->dalit_female_member + $committee->dalit_male_member }}</strong>
                </td>
            </tr>
            <tr>
                <td><strong>Janajati</strong></td>
                <td class="text-center">{{ $committee->janjati_female_key }}</td>
                <td class="text-center">{{ $committee->janjati_male_key }}</td>
                <td class="text-center">{{ $committee->janjati_female_member }}</td>
                <td class="text-center">{{ $committee->janjati_male_member }}</td>
                <td class="text-center">
                    <strong>{{ $committee->janjati_female_key + $committee->janjati_male_key + $committee->janjati_female_member + $committee->janjati_male_member }}</strong>
                </td>
            </tr>
            <tr>
                <td><strong>Others</strong></td>
                <td class="text-center">{{ $committee->others_female_key }}</td>
                <td class="text-center">{{ $committee->others_male_key }}</td>
                <td class="text-center">{{ $committee->others_female_member }}</td>
                <td class="text-center">{{ $committee->others_male_member }}</td>
                <td class="text-center">
                    <strong>{{ $committee->others_female_key + $committee->others_male_key + $committee->others_female_member + $committee->others_male_member }}</strong>
                </td>
            </tr>
            <tr style="background-color: #f3f4f6;">
                <td><strong>TOTAL</strong></td>
                <td class="text-center"><strong>{{ $committee->dalit_female_key + $committee->janjati_female_key + $committee->others_female_key }}</strong></td>
                <td class="text-center"><strong>{{ $committee->dalit_male_key + $committee->janjati_male_key + $committee->others_male_key }}</strong></td>
                <td class="text-center"><strong>{{ $committee->dalit_female_member + $committee->janjati_female_member + $committee->others_female_member }}</strong></td>
                <td class="text-center"><strong>{{ $committee->dalit_male_member + $committee->janjati_male_member + $committee->others_male_member }}</strong></td>
                <td class="text-center"><strong>
                    {{ 
                        $committee->dalit_female_key + $committee->dalit_male_key + $committee->dalit_female_member + $committee->dalit_male_member +
                        $committee->janjati_female_key + $committee->janjati_male_key + $committee->janjati_female_member + $committee->janjati_male_member +
                        $committee->others_female_key + $committee->others_male_key + $committee->others_female_member + $committee->others_male_member
                    }}
                </strong></td>
            </tr>
        </tbody>
    </table>

    @if($committee->remarks)
        <div class="section-header">6. Remarks</div>
        <div style="background: #fff; border: 1px solid #e5e7eb; padding: 10px; font-style: italic; color: #4b5563;">
            {{ $committee->remarks }}
        </div>
    @endif

    <div class="footer">
        © {{ date('Y') }} HELVETAS Nepal WSMIS | Water Scheme Management Information System
    </div>

</body>
</html>