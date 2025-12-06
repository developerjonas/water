<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel
{
    case ADMIN = 'admin';
    case DISTRICT = 'district';
    case MUNICIPAL = 'municipal';
    case VIEW_ONLY = 'view_only';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ADMIN => 'Super Admin',
            self::DISTRICT => 'District User',
            self::MUNICIPAL => 'Municipal User',
            self::VIEW_ONLY => 'Global Read-Only',
        };
    }
}