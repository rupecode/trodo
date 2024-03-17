<?php

namespace App\Services\AnyApiClient\Dto;

class AnyApiRateDto
{
    public function __construct(public string $currency, public float $rate)
    {

    }
}
