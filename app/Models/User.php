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

    protected $fillable = [
        'name',
        'email',
        'password',
        'district_code',
        'municipality_code',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'role' => UserRole::class,
    ];

    public function getFilamentName(): string
    {
        return "{$this->name} (" . ucfirst($this->role->value) . ")";
    }

    public function hasRole(UserRole $role): bool
    {
        return $this->role === $role;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_code', 'district_code');
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'municipality_code','municipality_code');
    }

    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return !is_null($this->role);
    }
}
