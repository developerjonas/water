<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SchemeAccessScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // // If running in console (artisan) or no user logged in, skip
        // if (app()->runningInConsole() || !auth()->check()) {
        //     return;
        // }

        // $user = auth()->user();

        // // Admin sees everything (no filter)
        // if ($user->hasRole('admin')) {
        //     return;
        // }

        // // District User Filter
        // if ($user->hasRole('district')) {
        //     $builder->where('district_id', $user->district_id);
        // }

        // // Municipal User Filter
        // elseif ($user->hasRole('municipal')) {
        //     $builder->where('municipality_id', $user->municipality_id);
        // }
    }
}