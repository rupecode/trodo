<?php

namespace App\Dto;

class CurrenciesResponseDto implements \JsonSerializable
{
    public function __construct(
        public string $lastUpdated,
        public float $minimum,
        public float $maximum,
        public string $currency,
        public float $average,
        public array $currencies
    ) {

    }

    public function jsonSerialize(): mixed
    {
        return (array)$this;
    }
}
