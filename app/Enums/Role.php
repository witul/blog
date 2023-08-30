<?php

namespace App\Enums;

use App\Interfaces\RoleInterface;
use Illuminate\Support\Collection;

enum Role: string implements RoleInterface
{
    case User = "user";
    case Editor = "editor";
    case Admin = "admin";

    /**
     * @return string
     */
    public function label(): string
    {
        return static::getLabel($this);
    }

    // Mapowanie opisów do wartości

    /**
     * @param Role $value
     * @return string
     */
    public static function getLabel(self $value): string
    {
        return match ($value) {
            static::User => 'Użytkownik',
            static::Editor => 'Redaktor',
            static::Admin => 'Administrator',
        };
    }


    // Jeden z pomysłów na zdefiniowanie uprawnień

    /**
     * @return array
     */
    public function permissions(): array
    {
        return match ($this) {
            static::User => [],
            static::Editor => [],
            static::Admin => [],
            default => []
        };
    }

    // konwersja typu do kolekcji

    /**
     * @return Collection
     */
    public static function collect(): Collection
    {
        return collect(static::cases());
    }

    // konwersja typu do tablicy klucz=>wartosc

    /**
     * @return Collection
     */
    public static function toSelect(): Collection
    {
        return static::collect()->mapWithKeys(function ($role) {
            return [$role->value => $role->label()];
        });
    }

    // pobranie jedynie wartości enuma

    /**
     * @return array
     */
    public static function values(): array {
        return static::toSelect()->keys()->toArray();
    }
}
