<?php

namespace App\Services\AnyApiClient\Dto;

class AnyApiDto
{
    /**
     * @param int $lastUpdate
     * @param string $base
     * @param AnyApiRateDto[] $rates
     */
    public function __construct(public int $lastUpdate, public string $base, public array $rates)
    {

    }
}
