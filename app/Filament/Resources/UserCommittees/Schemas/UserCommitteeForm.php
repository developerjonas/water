<?php

namespace App\Filament\Resources\UserCommittees\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;

use App\Models\Scheme;
use App\Models\Province;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Donor;

class UserCommitteeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([

                    // Step 1: Scheme & Formation
                    Wizard\Step::make('Scheme & Formation')
                        ->schema([
                            Select::make('province')
                                ->label('Province')
                                ->options(Province::pluck('name', 'id'))
                                ->reactive()
                                ->required()
                                ->afterStateUpdated(fn($state, callable $set) => $set('district', null)),

                            Select::make('district')
                                ->label('District')
                                ->options(function (callable $get) {
                                    $provinceId = $get('province');
                                    return $provinceId ? District::where('province_id', $provinceId)->pluck('name', 'id') : [];
                                })
                                ->reactive()
                                ->afterStateUpdated(fn($state, callable $set) => $set('municipality', null))
                                ->required(),

                            Select::make('municipality')
                                ->label('Municipality')
                                ->options(function (callable $get) {
                                    $districtId = $get('district');
                                    return $districtId ? Municipality::where('district_id', $districtId)->pluck('name', 'id') : [];
                                })
                                ->reactive()
                                ->required(),

                            Select::make('donor')
                                ->label('Donor')
                                ->options(Donor::pluck('name', 'id'))
                                ->nullable()
                                ->reactive(),

                            Select::make('scheme_code')
                                ->label('Scheme Code')
                                ->options(function (callable $get) {
                                    $province = $get('province');
                                    $district = $get('district');
                                    $mun = $get('municipality');
                                    $donor = $get('donor');

                                    $query = Scheme::query();

                                    if ($province) $query->where('province', $province);
                                    if ($district) $query->where('district', $district);
                                    if ($mun) $query->where('mun', $mun);
                                    if ($donor) $query->whereJsonContains('collaborator', $donor);

                                    return $query->pluck('scheme_code', 'scheme_code');
                                })
                                ->required()
                                ->searchable()
                                ->placeholder('Select Scheme Code')
                                ->helperText('Select the related scheme for this UC'),
                        ]),

                    // Step 2: Formation
                    Wizard\Step::make('Formation')
                        ->schema([
                            TextInput::make('user_committee_name')
                                ->label('User Committee Name')
                                ->placeholder('Enter the User Committee Name')
                                ->required(),

                            DatePicker::make('date_of_formation')
                                ->label('Date of Formation')
                                ->placeholder('YYYY-MM-DD'),

                            TextInput::make('user_committee_bank_account_name')
                                ->label('UC Bank Account Name')
                                ->placeholder('Enter WUSC bank account name'),
                        ]),

                    // Step 3: Key Positions
                    Wizard\Step::make('Key Positions')
                        ->schema([
                            TextInput::make('chair_name')->label('Chair Name')->required(),
                            TextInput::make('chair_contact')->label('Chair Contact')->required(),
                            TextInput::make('vice_chair_name')->label('Vice-Chair Name'),
                            TextInput::make('vice_chair_contact')->label('Vice-Chair Contact'),

                            TextInput::make('secretary_name')->label('Secretary Name'),
                            TextInput::make('secretary_contact')->label('Secretary Contact'),
                            TextInput::make('deputy_secretary_name')->label('Deputy Secretary Name'),
                            TextInput::make('deputy_secretary_contact')->label('Deputy Secretary Contact'),

                            TextInput::make('treasurer_name')->label('Treasurer Name'),
                            TextInput::make('treasurer_contact')->label('Treasurer Contact'),
                        ])->columns(2),

                    // Step 4: Dalit Members
                    Wizard\Step::make('Dalit Members')
                        ->schema([
                            TextInput::make('dalit_female_key')->label('Dalit Female Key')->numeric()->default(0),
                            TextInput::make('dalit_male_key')->label('Dalit Male Key')->numeric()->default(0),
                            TextInput::make('dalit_female_member')->label('Dalit Female Member')->numeric()->default(0),
                            TextInput::make('dalit_male_member')->label('Dalit Male Member')->numeric()->default(0),
                        ])->columns(2),

                    // Step 5: Janjati Members
                    Wizard\Step::make('Janjati Members')
                        ->schema([
                            TextInput::make('janjati_female_key')->label('Janjati Female Key')->numeric()->default(0),
                            TextInput::make('janjati_male_key')->label('Janjati Male Key')->numeric()->default(0),
                            TextInput::make('janjati_female_member')->label('Janjati Female Member')->numeric()->default(0),
                            TextInput::make('janjati_male_member')->label('Janjati Male Member')->numeric()->default(0),
                        ])->columns(2),

                    // Step 6: Other Members
                    Wizard\Step::make('Other Members')
                        ->schema([
                            TextInput::make('others_female_key')->label('Other Female Key')->numeric()->default(0),
                            TextInput::make('others_male_key')->label('Other Male Key')->numeric()->default(0),
                            TextInput::make('others_female_member')->label('Other Female Member')->numeric()->default(0),
                            TextInput::make('others_male_member')->label('Other Male Member')->numeric()->default(0),
                        ])->columns(2),

                    // Step 7: Registration & Contract
                    Wizard\Step::make('Registration & Contract')
                        ->schema([
                            Select::make('registration_status')
                                ->label('Registration Status')
                                ->options([
                                    'registered' => 'Registered',
                                    'in_progress' => 'In Progress',
                                    'not_registered' => 'Not Registered',
                                ])
                                ->required(),

                            TextInput::make('registration_number')->label('Registration Number'),
                            DatePicker::make('contract_date')->label('Contract Date')->placeholder('YYYY-MM-DD'),
                            DatePicker::make('contract_expiry_date')->label('Contract Expiry Date')->placeholder('YYYY-MM-DD'),

                            Textarea::make('remarks')
                                ->label('Remarks')
                                ->columnSpanFull()
                                ->placeholder('Any additional notes or remarks'),
                        ]),

                ])->columnSpanFull(),
            ]);
    }
}
