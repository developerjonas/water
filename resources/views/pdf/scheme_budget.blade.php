<!-- resources/views/pdf/scheme_budget.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Scheme Budget - {{ $schemeBudget->scheme_code }}</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        h3, p {
            margin: 0 0 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            page-break-inside: auto;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
        }
        .text-left {
            text-align: left;
        }
        .totals {
            font-weight: bold;
            background-color: #e0e0e0;
        }
        .signature-table {
            width: 100%;
            margin-top: 50px;
            border: none;
        }
        .signature-table td {
            border: none;
            text-align: center;
            padding-top: 50px;
        }
        @media print {
            body { font-size: 12pt; }
            table { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
    <h3>Scheme Budget: {{ $schemeBudget->scheme_code }}</h3>
    <p>Status: <strong>{{ $schemeBudget->status }}</strong> | Remarks: <strong>{{ $schemeBudget->remarks ?? '-' }}</strong></p>

    <table>
        <thead>
            <tr>
                <th rowspan="2" class="text-left">Description</th>
                <th rowspan="2">Total Estimated Cost</th>
                <th colspan="3">Advance</th>
                <th colspan="3">Settlement</th>
            </tr>
            <tr>
                <th>1</th><th>2</th><th>3</th>
                <th>1</th><th>2</th><th>3</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schemeBudget->budget_items as $item)
                <tr>
                    <td class="text-left">{{ $item->description }}</td>
                    <td>{{ number_format($item->total_estimated_cost, 2) }}</td>
                    <td>{{ number_format($item->advance_1, 2) }}</td>
                    <td>{{ number_format($item->advance_2, 2) }}</td>
                    <td>{{ number_format($item->advance_3, 2) }}</td>
                    <td>{{ number_format($item->settlement_1, 2) }}</td>
                    <td>{{ number_format($item->settlement_2, 2) }}</td>
                    <td>{{ number_format($item->settlement_3, 2) }}</td>
                </tr>
            @endforeach
            <tr class="totals">
                <td>Total</td>
                <td>{{ number_format($schemeBudget->budget_items->sum('total_estimated_cost'), 2) }}</td>
                <td>{{ number_format($schemeBudget->budget_items->sum('advance_1'), 2) }}</td>
                <td>{{ number_format($schemeBudget->budget_items->sum('advance_2'), 2) }}</td>
                <td>{{ number_format($schemeBudget->budget_items->sum('advance_3'), 2) }}</td>
                <td>{{ number_format($schemeBudget->budget_items->sum('settlement_1'), 2) }}</td>
                <td>{{ number_format($schemeBudget->budget_items->sum('settlement_2'), 2) }}</td>
                <td>{{ number_format($schemeBudget->budget_items->sum('settlement_3'), 2) }}</td>
            </tr>
        </tbody>
    </table>

    <table class="signature-table">
        <tr>
            <td>Prepared By</td>
            <td>Reviewed & Recommended</td>
            <td>Approved By</td>
        </tr>
        <tr>
            <td>______________________</td>
            <td>______________________</td>
            <td>______________________</td>
        </tr>
    </table>
</body>
</html>
