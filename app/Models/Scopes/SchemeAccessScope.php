<?php

namespace App\Models\Scopes;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SchemeAccessScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // 1. Skip filtering if running in console (artisan) or no user is logged in
        if (app()->runningInConsole() || !auth()->check()) {
            return;
        }

        /** @var \App\Models\User $user */
        $user = auth()->user();

        // 2. ADMIN: Returns everything, no filtering applied.
        if ($user->role === UserRole::ADMIN) {
            return;
        }

        // 3. DISTRICT USER: Filter by district_code
        if ($user->role === UserRole::DISTRICT) {
            $builder->where('district', $user->district_code);
        }

        // 4. MUNICIPAL USER: Filter by municipality_code
        elseif ($user->role === UserRole::MUNICIPAL) {
            $builder->where('mun', $user->municipality_code);
        }

        // 5. VIEW ONLY (Global)
        // Currently, this logic allows View Only users to see ALL data (like an admin).
        // If you want View Only users to essentially see "Nothing" or be restricted, 
        // you would add logic here. For now, it falls through and returns everything.
    }
}