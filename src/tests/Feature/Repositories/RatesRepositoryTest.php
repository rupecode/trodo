<?php

namespace Repositories;

use App\Enums\Currency;
use App\Enums\Sort;
use App\Models\Rate;
use App\Models\Rates;
use App\Repositories\RatesRepository;
use Tests\DbTestCase;

class RatesRepositoryTest extends DbTestCase
{
    private RatesRepository $ratesRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ratesRepository = app(RatesRepository::class);
    }

    public function testGetByCurrency(): void
    {
        $this->store(1);
        $data = $this->ratesRepository->getByCurrency(1, Currency::USD, Sort::ASC);

        self::assertTrue($data['total'] > 0);
    }

    public function testGetStats(): void
    {
        $this->store(1);
        $data = $this->ratesRepository->getStats(Currency::USD);

        self::assertArrayHasKey('lastUpdate', $data);
        self::assertArrayHasKey('minimum', $data);
        self::assertArrayHasKey('maximum', $data);
        self::assertArrayHasKey('average', $data);
    }

    private function store($day): void
    {
        $rate = new Rate();
        $rate->baseCurrency = 'EUR';
        $rate->lastUpdate = strtotime("-$day day");
        $rate->saveOrFail();
        $rate->refresh();

        $rates = new Rates();
        $rates->ratesId = $rate->id;
        $rates->currency = 'GBP';
        $rates->rate = 0.851;
        $rates->saveOrFail();

        $rates = new Rates();
        $rates->ratesId = $rate->id;
        $rates->currency = 'USD';
        $rates->rate = 1.1;
        $rates->saveOrFail();

        $rates = new Rates();
        $rates->ratesId = $rate->id;
        $rates->currency = 'AUD';
        $rates->rate = 1.65;
        $rates->saveOrFail();
    }
}
