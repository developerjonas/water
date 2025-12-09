<?php

// namespace App\Models\Scopes;

// use App\Enums\UserRole;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Scope;

// class SchemeAccessScope implements Scope
// {
//     /**
//      * Apply the scope to a given Eloquent query builder.
//      */
//     public function apply(Builder $builder, Model $model): void
//     {
//         // 1. Skip filtering if running in console (artisan) or no user is logged in
//         if (app()->runningInConsole() || !auth()->check()) {
//             return;
//         }

//         /** @var \App\Models\User $user */
//         $user = auth()->user();

//         // 2. ADMIN: Returns everything, no filtering applied.
//         if ($user->role === UserRole::ADMIN) {
//             return;
//         }

//         // 3. DISTRICT USER: Filter by district_code
//         if ($user->role === UserRole::DISTRICT) {
//             $builder->where('district', $user->district_code);
//         }

//         // 4. MUNICIPAL USER: Filter by municipality_code
//         elseif ($user->role === UserRole::MUNICIPAL) {
//             $builder->where('mun', $user->municipality_code);
//         }

//         // 5. VIEW ONLY (Global)
//         // Currently, this logic allows View Only users to see ALL data (like an admin).
//         // If you want View Only users to essentially see "Nothing" or be restricted, 
//         // you would add logic here. For now, it falls through and returns everything.
//     }



// namespace App\Models\Scopes;

// use App\Enums\UserRole;
// use App\Models\District;      // Import this
// use App\Models\Municipality;  // Import this
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Scope;

// class SchemeAccessScope implements Scope
// {
//     public function apply(Builder $builder, Model $model): void
//     {
//         // 1. Skip if console or guest
//         if (app()->runningInConsole() || !auth()->check()) {
//             return;
//         }

//         /** @var \App\Models\User $user */
//         $user = auth()->user();

//         // 2. ADMIN & SUPER_ADMIN: See everything
//         if (in_array($user->role, [UserRole::ADMIN, UserRole::ADMIN])) {
//             return;
//         }

//         // 3. DISTRICT USER: Filter by Code OR Name
//         if ($user->role === UserRole::DISTRICT) {
//             $userCode = $user->district_code; // e.g., "ACH"
            
//             // Look up the full name from the Districts table (e.g., "Achham")
//             $districtName = District::where('district_code', $userCode)->value('name');

//             $builder->where(function (Builder $query) use ($userCode, $districtName) {
//                 // Check if the column matches the Code ("ACH")
//                 $query->where('district', $userCode);
                
//                 // OR check if it matches the Name ("Achham")
//                 if ($districtName) {
//                     $query->orWhere('district', $districtName);
//                 }
//             });
//         }

//         // 4. MUNICIPAL USER: Filter by Code OR Name
//         elseif ($user->role === UserRole::MUNICIPAL) {
//             $userCode = $user->municipality_code; // e.g., "KML"
            
//             // Look up the full name (e.g., "Kamalbazar Municipality")
//             $munName = Municipality::where('municipality_code', $userCode)->value('name');

//             $builder->where(function (Builder $query) use ($userCode, $munName) {
//                 // Check Code
//                 $query->where('mun', $userCode);
                
//                 // OR Check Name
//                 if ($munName) {
//                     $query->orWhere('mun', $munName);
//                 }
//             });
//         }
//     }


namespace App\Models\Scopes;

use App\Enums\UserRole;
use App\Models\District;
use App\Models\Municipality;
use App\Models\Scheme;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SchemeAccessScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        // 1. Skip for Admins, Console, or Guests
        if (app()->runningInConsole() || !auth()->check()) {
            return;
        }

        /** @var \App\Models\User $user */
        $user = auth()->user();

        if (in_array($user->role, [UserRole::ADMIN, UserRole::ADMIN])) {
            return;
        }

        // 2. Define the filtering logic (The "Robust" Logic)
        // We put this in a closure so we can reuse it for both cases
        $filterLogic = function (Builder $query) use ($user) {
            
            // DISTRICT USER
            if ($user->role === UserRole::DISTRICT) {
                $userCode = $user->district_code; 
                $districtName = District::where('district_code', $userCode)->value('name');

                $query->where(function ($q) use ($userCode, $districtName) {
                    $q->where('district', $userCode);
                    if ($districtName) {
                        $q->orWhere('district', $districtName);
                    }
                });
            }

            // MUNICIPAL USER
            elseif ($user->role === UserRole::MUNICIPAL) {
                $userCode = $user->municipality_code;
                $munName = Municipality::where('municipality_code', $userCode)->value('name');

                $query->where(function ($q) use ($userCode, $munName) {
                    $q->where('mun', $userCode);
                    if ($munName) {
                        $q->orWhere('mun', $munName);
                    }
                });
            }
        };

        // 3. APPLY THE LOGIC
        
        // Case A: We are querying the 'schemes' table directly
        if ($model instanceof Scheme) {
            $filterLogic($builder);
        } 
        // Case B: We are querying a Child (WaterPoint, Structure, etc.)
        // We assume the child has a 'scheme()' relationship defined.
        else {
            $builder->whereHas('scheme', $filterLogic);
        }
    }
}
