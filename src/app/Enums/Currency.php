<?php

namespace App\Enums;

use ValueError;

enum Currency
{
    case GBP;
    case USD;
    case AUD;

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
