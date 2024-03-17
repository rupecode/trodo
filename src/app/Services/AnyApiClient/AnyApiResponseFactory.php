<?php

namespace App\Services\AnyApiClient;

use App\Factories\MoneyFormatter;
use App\Services\AnyApiClient\Dto\AnyApiDto;
use App\Services\AnyApiClient\Dto\AnyApiRateDto;

class AnyApiResponseFactory
{
    public function __construct(private MoneyFormatter $moneyFormatter)
    {

    }

    public function fromString(string $body): AnyApiDto
    {
        $data = json_decode($body, true);
        $rates = [];

        foreach ($data['rates'] as $currency => $rate) {
            $rates[] = new AnyApiRateDto($currency, $this->moneyFormatter->format($rate));
        }

        return new AnyApiDto($data['lastUpdate'], $data['base'], $rates);
    }
}
