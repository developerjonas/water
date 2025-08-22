<h1>{{ $scheme->scheme_name }}</h1>
<p><strong>Location:</strong> {{ $scheme->district }}, {{ $scheme->mun }}</p>
<p><strong>Duration:</strong> {{ $scheme->scheme_start_year }} - {{ $scheme->actual_completed_date?->format('Y') ?? 'Ongoing' }}</p>

<h2>Beneficiaries</h2>
<ul>
@foreach($beneficiaries as $b)
    <li>Dalit HH Poor: {{ $b->dalit_hh_poor }}, Dalit HH Non-Poor: {{ $b->dalit_hh_nonpoor }}</li>
@endforeach
</ul>

<h2>Structures</h2>
<ul>
@foreach($structures as $s)
    <li>Public taps: {{ $s->public_taps }}, School taps: {{ $s->school_taps }}</li>
@endforeach
</ul>

<h2>Water Quality Tests</h2>
<table>
    <thead>
        <tr>
            <th>Tested Point</th>
            <th>E. coli</th>
            <th>Coliform</th>
            <th>pH</th>
            <th>FRC</th>
            <th>Turbidity</th>
        </tr>
    </thead>
    <tbody>
        @foreach($waterQualityTests as $wqt)
        <tr>
            <td>{{ $wqt->tested_point }}</td>
            <td>{{ $wqt->ecoli }}</td>
            <td>{{ $wqt->coliform }}</td>
            <td>{{ $wqt->ph }}</td>
            <td>{{ $wqt->frc }}</td>
            <td>{{ $wqt->turbidity }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
