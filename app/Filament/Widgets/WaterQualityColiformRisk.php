<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Filament\Forms;
use Illuminate\Support\Facades\DB;

class WaterQualityColiformRisk extends ChartWidget
{
    protected ?string $heading = 'Coliform Risk';
    protected ?string $pollingInterval = null;

    // Dropdown state
    public ?string $selectedProvince = null;
    public ?string $selectedDistrict = null;
    public ?string $selectedMunicipality = null;
    public ?string $selectedScheme = null;

    public array $provinceOptions = [];
    public array $districtOptions = [];
    public array $municipalityOptions = [];
    public array $schemeOptions = [];

    // Load options on mount
    public function mount(): void
    {
        $this->provinceOptions = DB::table('schemes')->distinct()->pluck('province', 'province')->toArray();
    }

    public function updatedSelectedProvince(): void
    {
        $this->districtOptions = DB::table('schemes')
            ->where('province', $this->selectedProvince)
            ->distinct()
            ->pluck('district', 'district')
            ->toArray();

        $this->selectedDistrict = null;
        $this->selectedMunicipality = null;
        $this->schemeOptions = [];
        $this->selectedScheme = null;

        $this->resetChart();
    }

    public function updatedSelectedDistrict(): void
    {
        $this->municipalityOptions = DB::table('schemes')
            ->where('province', $this->selectedProvince)
            ->where('district', $this->selectedDistrict)
            ->distinct()
            ->pluck('mun', 'mun')
            ->toArray();

        $this->selectedMunicipality = null;
        $this->schemeOptions = [];
        $this->selectedScheme = null;

        $this->resetChart();
    }

    public function updatedSelectedMunicipality(): void
    {
        $this->schemeOptions = DB::table('schemes')
            ->where('province', $this->selectedProvince)
            ->where('district', $this->selectedDistrict)
            ->where('mun', $this->selectedMunicipality)
            ->pluck('scheme_code', 'scheme_code')
            ->toArray();

        $this->selectedScheme = null;
        $this->resetChart();
    }

    public function updatedSelectedScheme(): void
    {
        $this->resetChart();
    }

    // Chart data
    protected function getData(): array
    {
        $query = DB::table('water_quality_tests')
            ->join('schemes', 'water_quality_tests.scheme_code', '=', 'schemes.scheme_code');

        if ($this->selectedProvince) {
            $query->where('schemes.province', $this->selectedProvince);
        }
        if ($this->selectedDistrict) {
            $query->where('schemes.district', $this->selectedDistrict);
        }
        if ($this->selectedMunicipality) {
            $query->where('schemes.mun', $this->selectedMunicipality);
        }
        if ($this->selectedScheme) {
            $query->where('water_quality_tests.scheme_code', $this->selectedScheme);
        }

        $data = $query->get();

        $counts = [
            'Zero' => 0,
            'Low risk' => 0,
            'Risk' => 0,
            'High risk' => 0,
        ];

        foreach ($data as $row) {
            $val = $row->coliform; // note: using coliform
            if ($val === 0)
                $counts['Zero']++;
            elseif ($val >= 1 && $val <= 10)
                $counts['Low risk']++;
            elseif ($val >= 11 && $val <= 100)
                $counts['Risk']++;
            else
                $counts['High risk']++;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Coliform Risk',
                    'data' => array_values($counts),
                    'backgroundColor' => [
                        '#4caf50', // green
                        '#ffeb3b', // yellow
                        '#ff9800', // orange
                        '#f44336', // red
                    ],
                ],
            ],
            'labels' => array_keys($counts),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    // Filament forms inside widget header
    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('selectedProvince')
                ->label('Province')
                ->options($this->provinceOptions)
                ->reactive(),

            Forms\Components\Select::make('selectedDistrict')
                ->label('District')
                ->options($this->districtOptions)
                ->reactive(),

            Forms\Components\Select::make('selectedMunicipality')
                ->label('Municipality')
                ->options($this->municipalityOptions)
                ->reactive(),

            Forms\Components\Select::make('selectedScheme')
                ->label('Scheme')
                ->options($this->schemeOptions)
                ->reactive(),
        ];
    }
}
