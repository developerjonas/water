<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Water Quality Report</title>
    <style>
        body { font-family: sans-serif; margin: 20px; color: #333; }
        h1, h2 { color: #1E40AF; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #1E40AF; color: white; }
        .remarks { margin-top: 20px; font-style: italic; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        .header div { font-size: 14px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Water Quality Test Report</h1>
        <div>Date: {{ now()->format('Y-m-d') }}</div>
    </div>

    <h2>Scheme: {{ $data->scheme_code }}</h2>
    <p>Tested Point: {{ $data->tested_point }}</p>

    <table>
        <thead>
            <tr>
                <th>ECOLI</th>
                <th>Coliform</th>
                <th>pH</th>
                <th>FRC</th>
                <th>Turbidity</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $data->ecoli ?? 'N/A' }}</td>
                <td>{{ $data->coliform ?? 'N/A' }}</td>
                <td>{{ $data->ph ?? 'N/A' }}</td>
                <td>{{ $data->frc ?? 'N/A' }}</td>
                <td>{{ $data->turbidity ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>

    @if($data->remarks)
    <div class="remarks">
        <strong>Remarks:</strong> {{ $data->remarks }}
    </div>
    @endif
</body>
</html>
