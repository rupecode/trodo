<?php

namespace App\Services;

use App\Dto\CurrenciesResponseDto;
use App\Dto\RateResponseDto;
use App\Enums\Currency;
use App\Enums\Sort;
use App\Factories\PaginatedFactory;
use App\Repositories\RatesRepository;
use Illuminate\Support\Facades\DB;

class RatesService
{
    public function __construct(private RatesRepository $ratesRepository)
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
            $rates[] = new RateResponseDto($item['id'], $item['lastUpdate'], $item['rate']);
        }

        return (new PaginatedFactory())->create(
            $res['total'],
            new CurrenciesResponseDto(
                $data[0]['lastUpdate'],
                0.97504,
                1.1103,
                $data[0]['currency'],
                1.0587,
                $rates
            )
        );
    }
}
