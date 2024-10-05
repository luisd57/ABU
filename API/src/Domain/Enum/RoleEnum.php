<?php

namespace App\Domain\Enum;

enum RoleEnum: string
{
    case USER      = 'ROLE_USER';
    case THERAPIST = 'ROLE_THERAPIST';
    case ADMIN     = 'ROLE_ADMIN';

    public static function fromString(string $role): self
    {
        return match ($role) {
            'ROLE_USER' => self::USER,
            'ROLE_THERAPIST' => self::THERAPIST,
            'ROLE_ADMIN' => self::ADMIN,
            default => throw new \InvalidArgumentException("Invalid role: $role"),
        };
    }

    public static function toArray(array $roles): array
    {
        return array_map(fn(RoleEnum $role) => $role->value, $roles);
    }
}