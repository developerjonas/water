<?php

namespace App\Filament\Components;

use Filament\Forms\Components\Select;
use App\Models\Scheme;
use App\Models\Province;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Donor;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Auth;

class SchemeSelector
{
    /**
     * Returns a schema array for Filament wizard/form
     *
     * @param string $schemeFieldName The field name for the scheme select
     * @return array
     */
    public static function make(string $schemeFieldName = 'scheme_code'): array
    {
        return [
            Select::make('province')
                ->label('Province')
                ->options(function () {
                    // Admins see all active provinces
                    // Restricted users see only their assigned province (via District)
                    
                    /** @var \App\Models\User $user */
                    $user = Auth::user();

                    $query = Province::where('is_active', 1);

                    if ($user->role === UserRole::DISTRICT || $user->role === UserRole::MUNICIPAL) {
                         // Find the province of the user's assigned district
                         $userProvince = District::where('district_code', $user->district_code)->value('province_code');
                         if ($userProvince) {
                             $query->where('province_code', $userProvince);
                         }
                    }
                    
                    return $query->pluck('name', 'province_code');
                })
                ->default(function () {
                    /** @var \App\Models\User $user */
                    $user = Auth::user();
                    if ($user->role === UserRole::DISTRICT || $user->role === UserRole::MUNICIPAL) {
                        return District::where('district_code', $user->district_code)->value('province_code');
                    }
                    return null;
                })
                // Disable if the user is restricted
                ->disabled(fn() => in_array(Auth::user()->role, [UserRole::DISTRICT, UserRole::MUNICIPAL]))
                ->dehydrated() // Important: Ensure the value is saved/passed even if disabled
                ->reactive()
                ->columnSpan(1)
                ->afterStateUpdated(fn($state, callable $set) => $set('district', null)),

            Select::make('district')
                ->label('District')
                ->options(function (callable $get) {
                    /** @var \App\Models\User $user */
                    $user = Auth::user();
                    
                    // If restricted, only show their own district
                    if ($user->role === UserRole::DISTRICT || $user->role === UserRole::MUNICIPAL) {
                         return District::where('district_code', $user->district_code)
                             ->pluck('name', 'district_code');
                    }

                    // Admin logic: Show districts for selected province
                    $provinceId = $get('province');
                    return $provinceId
                        ? District::where('province_code', $provinceId)
                            ->where('is_active', 1)
                            ->pluck('name', 'district_code')
                        : [];
                })
                ->default(fn() => in_array(Auth::user()->role, [UserRole::DISTRICT, UserRole::MUNICIPAL]) ? Auth::user()->district_code : null)
                ->disabled(fn() => in_array(Auth::user()->role, [UserRole::DISTRICT, UserRole::MUNICIPAL]))
                ->dehydrated()
                ->reactive()
                ->columnSpan(1)
                ->afterStateUpdated(fn($state, callable $set) => $set('municipality', null)),

            Select::make('municipality')
                ->label('Municipality')
                ->options(function (callable $get) {
                    /** @var \App\Models\User $user */
                    $user = Auth::user();

                    // If Municipal User, only show their own municipality
                    if ($user->role === UserRole::MUNICIPAL) {
                        return Municipality::where('municipality_code', $user->municipality_code)
                            ->pluck('name', 'municipality_code');
                    }

                    // Admin/District User logic: Show municipalities for selected district
                    $districtId = $get('district');
                    return $districtId
                        ? Municipality::where('district_code', $districtId)
                            ->where('is_active', 1)
                            ->pluck('name', 'municipality_code')
                        : [];
                })
                ->default(fn() => (Auth::user()->role === UserRole::MUNICIPAL) ? Auth::user()->municipality_code : null)
                ->disabled(fn() => Auth::user()->role === UserRole::MUNICIPAL)
                ->dehydrated()
                ->reactive()
                ->columnSpan(1),

            Select::make('donor')
                ->label('Donor')
                ->options(Donor::pluck('name', 'id'))
                ->nullable()
                ->columnSpan(1)
                ->reactive(),

            Select::make($schemeFieldName)
                ->label('Scheme Name')
                ->options(function (callable $get) {
                    /** @var \App\Models\User $user */
                    $user = Auth::user();

                    // Resolve the filters.
                    // If the user is restricted, we use their fixed codes.
                    // If the user is Admin, we use the form inputs ($get).
                    
                    $isRestrictedLocation = in_array($user->role, [UserRole::DISTRICT, UserRole::MUNICIPAL]);
                    
                    // Province
                    $province = $isRestrictedLocation
                         ? District::where('district_code', $user->district_code)->value('province_code') 
                         : $get('province');
                    
                    // District
                    $district = $isRestrictedLocation 
                         ? $user->district_code 
                         : $get('district');
                    
                    // Municipality
                    $mun = ($user->role === UserRole::MUNICIPAL) 
                         ? $user->municipality_code 
                         : $get('municipality');
                    
                    $donor = $get('donor');

                    $query = Scheme::query();

                    if ($province)
                        $query->where('province', $province);
                    if ($district)
                        $query->where('district', $district);
                    if ($mun)
                        $query->where('mun', $mun);
                    if ($donor)
                        $query->whereJsonContains('collaborator', $donor);

                    return $query->pluck('scheme_name', 'scheme_code');
                })
                ->required()
                ->searchable()
                ->placeholder('Select Scheme Name')
                ->columnSpan(2),
        ];
    }
}