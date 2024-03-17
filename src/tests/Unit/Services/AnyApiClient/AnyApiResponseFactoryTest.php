<?php

namespace Tests\Unit\Services\AnyApiClient;

use App\Factories\MoneyFormatter;
use App\Services\AnyApiClient\AnyApiResponseFactory;
use PHPUnit\Framework\TestCase;

class AnyApiResponseFactoryTest extends TestCase
{
    private AnyApiResponseFactory $factory;

    protected function setUp(): void
    {
        $this->factory = new AnyApiResponseFactory(new MoneyFormatter());
        $this->response = file_get_contents(__DIR__ . '/response.json');
    }

    public function testOk(): void
    {
        $dto = $this->factory->fromString($this->response);

        self::assertEquals(1710288000, $dto->lastUpdate);
        self::assertEquals('EUR', $dto->base);
        self::assertCount(31, $dto->rates);
    }
}
