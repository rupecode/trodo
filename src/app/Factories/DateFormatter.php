<?php

namespace App\Factories;

class DateFormatter
{
    public function fromUnixTimeToDate(int $value): string
    {
        return date('d.m.Y', $value);
    }
}
