<?php

namespace App\Filament\Clusters\Settings;

use BackedEnum;
use Filament\Clusters\Cluster;
use Filament\Support\Icons\Heroicon;
// use Illuminate\Support\Facades\Auth;
// use App\Enums\UserRole;
class SettingsCluster extends Cluster
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Cog;

    protected static ?int $navigationSort = 999;

    // public static function canAccess(): bool
    // {
    //     $user = Auth::user();

    //     return $user->hasRole(UserRole::ADMIN);

    //     // Checking multiple roles
    //     // return in_array($user->role, [UserRole::SUPER_ADMIN, UserRole::ADMIN]);
    // }




}
