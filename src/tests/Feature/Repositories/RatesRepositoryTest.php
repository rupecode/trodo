<?php

namespace Repositories;

use App\Enums\Currency;
use App\Repositories\RatesRepository;
use Tests\TestCase;

class RatesRepositoryTest extends TestCase
{
    private RatesRepository $ratesRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ratesRepository = app(RatesRepository::class);
    }

    public function testOk(): void
    {
        $this->ratesRepository->getByCurrency(Currency::USD);
    }
}
