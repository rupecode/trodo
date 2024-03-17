<?php

namespace App\Dto;

class RateResponseDto implements \JsonSerializable
{
    public function __construct(
        public int $id,
        public string $date,
        public float $rate,
    ) {
    }

    public function jsonSerialize(): mixed
    {
        return (array)$this;
    }
}
