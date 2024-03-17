<?php

namespace App\Enums;

use ValueError;

enum Sort
{
    case ASC;
    case DESC;

    public static function from(string $name): self
    {
        foreach (self::cases() as $item) {
            if ($name === $item->name) {
                return $item;
            }
        }

        throw new ValueError("$name is not a valid backing value for enum " . self::class);
    }
}
