<?php

namespace Tests\Unit\Services;

use App\Enums\Currency;
use App\Enums\Sort;
use App\Factories\DateFormatter;
use App\Factories\MoneyFormatter;
use App\Repositories\RatesRepository;
use App\Services\RatesService;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RatesServiceTest extends TestCase
{
    private RatesService $service;
    private RatesRepository|MockObject $ratesRepository;

    protected function setUp(): void
    {
        $this->ratesRepository = $this->createMock(RatesRepository::class);
        $this->service = new RatesService(
            $this->ratesRepository,
            new MoneyFormatter(),
            new DateFormatter()
        );
    }

    public function testRates(): void
    {
        $this->ratesRepository
            ->expects(self::once())
            ->method('getByCurrency')
            ->with(1, Currency::USD, Sort::ASC)
            ->willReturn(['total' => 1, 'data' => [
                [
                    'lastUpdate' => time(),
                    'rate' => 1.13900897,
                    'id' => 1,
                    'currency' => 'USD',
                ]
            ]]);

        $this->ratesRepository
            ->expects(self::once())
            ->method('getStats')
            ->with(Currency::USD)
            ->willReturn([
                'lastUpdate' => 1,
                'minimum' => 1,
                'maximum' => 1,
                'average' => 1,
            ]);

        $data = $this->service->rates(1, Currency::USD, Sort::ASC);

        self::assertEquals(1, $data['total']);
        self::assertEquals(1, $data['pageCount']);
        self::assertTrue($data['data'] > 0);
    }
}
