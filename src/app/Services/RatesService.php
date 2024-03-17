<?php

namespace App\Services;

use App\Dto\CurrenciesResponseDto;
use App\Dto\RateResponseDto;
use App\Enums\Currency;
use App\Enums\Sort;
use App\Factories\DateFormatter;
use App\Factories\MoneyFormatter;
use App\Factories\PaginatedFactory;
use App\Repositories\RatesRepository;

class RatesService
{
    public function __construct(
        private RatesRepository $ratesRepository,
        private MoneyFormatter $moneyFormatter,
        private DateFormatter $dateFormatter
    )
    {
    }

    public function rates(int $page, Currency $currency, Sort $sort): array
    {
        $res = $this->ratesRepository->getByCurrency($page, $currency, $sort);
        $data = $res['data'];

        if (count($data) < 1) {
            return (new PaginatedFactory())->create(
                0,
                new CurrenciesResponseDto(
                    '',
                    0,
                    0,
                    '',
                    0,
                    []
                )
            );
        }

        $rates = [];

        foreach ($data as $item) {
            $rates[] = new RateResponseDto(
                $item['id'],
                $this->dateFormatter->fromUnixTimeToDate($item['lastUpdate']),
                $this->moneyFormatter->format($item['rate'])
            );
        }

        $stats = $this->ratesRepository->getStats($currency);

        return (new PaginatedFactory())->create(
            $res['total'],
            new CurrenciesResponseDto(
                $this->dateFormatter->fromUnixTimeToDate($stats['lastUpdate']),
                $this->moneyFormatter->format($stats['minimum']),
                $this->moneyFormatter->format($stats['maximum']),
                $data[0]['currency'],
                $this->moneyFormatter->format($stats['average']),
                $rates
            )
        );
    }
}
