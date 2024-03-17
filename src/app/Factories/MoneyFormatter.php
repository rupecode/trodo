<?php

namespace App\Factories;

class MoneyFormatter
{
    public function format(float $value): float
    {
        return round($value, 6);
    }
}
