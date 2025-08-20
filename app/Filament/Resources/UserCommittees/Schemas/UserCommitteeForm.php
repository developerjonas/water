<?php

namespace App\Filament\Resources\UserCommittees\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;

use App\Models\Scheme;

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
                            Select::make('scheme_code')
                                ->label('Scheme Code')
                                ->options(Scheme::pluck('scheme_code', 'scheme_code'))
                                ->searchable()
                                ->required()
                                ->placeholder('Select Scheme Code')
                                ->helperText('Select the related scheme for this UC'),
                            DatePicker::make('date_of_formation')
                                ->label('Date of Formation')
                                ->placeholder('YYYY-MM-DD'),
                            TextInput::make('user_committee_bank_account_name')
                                ->label('UC Bank Account Name')
                                ->placeholder('Enter WUSC bank account name'),
                        ]),

                    // Step 2: Key Positions
                    Wizard\Step::make('Key Positions')
                        ->schema([
                            TextInput::make('chair_name')->label('Chair Name')->placeholder('Enter Chair name')->required(),
                            TextInput::make('chair_contact')->label('Chair Contact')->placeholder('Enter Chair contact')->required(),
                            TextInput::make('vice_chair_name')->label('Vice-Chair Name')->placeholder('Enter Vice-Chair name'),
                            TextInput::make('vice_chair_contact')->label('Vice-Chair Contact')->placeholder('Enter Vice-Chair contact'),
                            TextInput::make('secretary_name')->label('Secretary Name')->placeholder('Enter Secretary name'),
                            TextInput::make('secretary_contact')->label('Secretary Contact')->placeholder('Enter Secretary contact'),
                            TextInput::make('deputy_secretary_name')->label('Deputy Secretary Name')->placeholder('Enter Deputy Secretary name'),
                            TextInput::make('deputy_secretary_contact')->label('Deputy Secretary Contact')->placeholder('Enter Deputy Secretary contact'),
                            TextInput::make('treasurer_name')->label('Treasurer Name')->placeholder('Enter Treasurer name'),
                            TextInput::make('treasurer_contact')->label('Treasurer Contact')->placeholder('Enter Treasurer contact'),
                        ]),

                    // Step 3: Dalit Members
                    Wizard\Step::make('Dalit Members')
                        ->schema([
                            TextInput::make('dalit_female_key')->label('Dalit Female Key')->numeric()->default(0),
                            TextInput::make('dalit_male_key')->label('Dalit Male Key')->numeric()->default(0),
                            TextInput::make('dalit_female_member')->label('Dalit Female Member')->numeric()->default(0),
                            TextInput::make('dalit_male_member')->label('Dalit Male Member')->numeric()->default(0),
                        ]),

                    // Step 4: Janjati Members
                    Wizard\Step::make('Janjati Members')
                        ->schema([
                            TextInput::make('janjati_female_key')->label('Janjati Female Key')->numeric()->default(0),
                            TextInput::make('janjati_male_key')->label('Janjati Male Key')->numeric()->default(0),
                            TextInput::make('janjati_female_member')->label('Janjati Female Member')->numeric()->default(0),
                            TextInput::make('janjati_male_member')->label('Janjati Male Member')->numeric()->default(0),
                        ]),

                    // Step 5: Other Members
                    Wizard\Step::make('Other Members')
                        ->schema([
                            TextInput::make('others_female_key')->label('Other Female Key')->numeric()->default(0),
                            TextInput::make('others_male_key')->label('Other Male Key')->numeric()->default(0),
                            TextInput::make('others_female_member')->label('Other Female Member')->numeric()->default(0),
                            TextInput::make('others_male_member')->label('Other Male Member')->numeric()->default(0),
                        ]),

                    // Step 6: Registration & Contract
                    Wizard\Step::make('Registration & Contract')
                        ->schema([
                            TextInput::make('wusc_registration_status')->label('WUSC Registration Status')->placeholder('Registered / Not Registered'),
                            TextInput::make('registration_number')->label('Registration Number')->placeholder('Enter registration number'),
                            DatePicker::make('contract_date')->label('Contract Date')->placeholder('YYYY-MM-DD'),
                            DatePicker::make('contract_expiry_date')->label('Contract Expiry Date')->placeholder('YYYY-MM-DD'),
                            Textarea::make('remarks')->label('Remarks')->columnSpanFull()->placeholder('Any additional notes or remarks'),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
