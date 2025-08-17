<?php

namespace App\Filament\Resources\Trainings\Schemas;

use App\Models\Scheme;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
// use Filament\Schemas\Components\TextInput;
// use Filament\Schemas\Components\Select;
// use Filament\Schemas\Components\DatePicker;
// use Filament\Schemas\Components\Textarea;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Utilities\Get;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\MultiSelect;

class TrainingForm
{
    public static function schema(): array
    {
        return [
            Wizard::make([
                Step::make('Find Scheme')
                    ->schema([
                        Section::make('Search by Location or Code')
                            ->schema([
                                Grid::make(6)
                                    ->schema([
                                        TextInput::make('province')
                                            ->label('Province')
                                            ->live(onBlur: true)
                                            ->columnSpan(2),
                                        TextInput::make('district')
                                            ->label('District')
                                            ->live(onBlur: true)
                                            ->columnSpan(2),
                                        TextInput::make('mun')
                                            ->label('Municipality')
                                            ->live(onBlur: true)
                                            ->columnSpan(2),
                                        TextInput::make('scheme_code')
                                            ->label('Scheme Code')
                                            ->live(onBlur: true)
                                            ->columnSpanFull(), // full width
                                        Select::make('scheme_id')
                                            ->label('Select Scheme')
                                            ->required()
                                            ->searchable()
                                            ->options(function (Get $get) {
                                                return Scheme::query()
                                                    ->when($get('province'), fn($q, $v) => $q->where('province', 'like', "%{$v}%"))
                                                    ->when($get('district'), fn($q, $v) => $q->where('district', 'like', "%{$v}%"))
                                                    ->when($get('mun'), fn($q, $v) => $q->where('mun', 'like', "%{$v}%"))
                                                    ->when($get('scheme_code'), fn($q, $v) => $q->where('scheme_code', 'like', "%{$v}%"))
                                                    ->orderBy('scheme_name')
                                                    ->limit(50)
                                                    ->pluck('scheme_name', 'id')
                                                    ->toArray();
                                            })
                                            ->placeholder('Start typing filters and pick a scheme')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ]),

                Step::make('Training Details')
                    ->description('Provide the training information.')
                    ->schema([
                        Section::make('Training Info')
                            ->schema([
                                Grid::make(2)->schema([
                                    TextInput::make('training_type')->required()->columnSpanFull(),
                                    TextInput::make('training_name')->required()->columnSpanFull(),
                                    DatePicker::make('training_start_date')->columnSpanFull(),
                                    DatePicker::make('training_end_date')->columnSpanFull(),
                                    TextInput::make('training_days')->numeric()->columnSpanFull(),
                                    TextInput::make('training_place')->columnSpanFull(),
                                    TextInput::make('facilitator_name')->columnSpanFull(),
                                    TextInput::make('num_participating_schools')->numeric()->columnSpanFull(),
                                    TextInput::make('teacher_count')->numeric()->columnSpanFull(),
                                    TextInput::make('child_club_count')->numeric()->columnSpanFull(),
                                    TextInput::make('school_mgmt_committee_count')->numeric()->columnSpanFull(),
                                    TextInput::make('dalit_male')->numeric()->columnSpanFull(),
                                    TextInput::make('dalit_female')->numeric()->columnSpanFull(),
                                    TextInput::make('dalit_total')->numeric()->columnSpanFull(),
                                    TextInput::make('janjati_male')->numeric()->columnSpanFull(),
                                    TextInput::make('janjati_female')
                                        ->numeric()
                                        ->columnSpanFull(),
                                    TextInput::make('janjati_total')->numeric()->columnSpanFull(),
                                    TextInput::make('other_male')->numeric()->columnSpanFull(),
                                    TextInput::make('other_female')->numeric()->columnSpanFull(),
                                    TextInput::make('other_total')->numeric()->columnSpanFull(),
                                    TextInput::make('male_total')->numeric()->columnSpanFull(),
                                    TextInput::make('female_total')->numeric()->columnSpanFull(),
                                    TextInput::make('total')->numeric()->columnSpanFull(),
                                    TextInput::make('num_schemes_participants')->numeric()->columnSpanFull(),
                                    Textarea::make('other')->columnSpanFull(),
                                ]),
                            ]),
                    ]),
            ])->columnSpanFull(), // ← make wizard full width
        ];
    }
}

