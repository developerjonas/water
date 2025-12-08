<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel
{
    case ADMIN = 'admin';
    case DISTRICT = 'district';
    case MUNICIPAL = 'municipal';
    case VIEWER = 'viewer';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::ADMIN => 'Admin',
            self::DISTRICT => 'District',
            self::MUNICIPAL => 'Municipal',
            self::VIEWER => 'Viewer',
        };
    }
}