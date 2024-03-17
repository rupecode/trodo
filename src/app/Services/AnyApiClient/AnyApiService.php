<?php

namespace App\Services\AnyApiClient;

use App\Repositories\RatesRepository;

class AnyApiService
{
    private array $allowedCurrencies;

    public function __construct(private AnyApiClient $anyApiClient, private RatesRepository $ratesRepository)
    {
        $this->allowedCurrencies = config('anyapi.currencies');
    }

    public function store(): int
    {
        return $this->ratesRepository->save(
            $this->anyApiClient->get(),
            $this->allowedCurrencies
        );
    }
}
