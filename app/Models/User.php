<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use App\Enums\UserRole;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * Allow any user to access the Filament admin panel (for demo purposes)
     */


    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'district_code',
        'municipality_code',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean', // cast to boolean
    ];

    /**
     * Scope: only active users
     */
    // public function scopeActive($query)
    // {
    //     return $query->where('is_active', true);
    // }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_code', 'district_code');
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality_code','municipality_code');
    }

    // --- HELPER METHODS ---

    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }

    // --- FILAMENT ACCESS ---

    public function canAccessPanel(Panel $panel): bool
    {
        // Only allow access if they have a role assigned
        return !is_null($this->role);
    }
}
