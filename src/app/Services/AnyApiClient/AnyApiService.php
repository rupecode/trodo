<?php

namespace App\Services\AnyApiClient;

use App\Repositories\RatesRepository;

class AnyApiService
{
    public function __construct(private AnyApiClient $anyApiClient, private RatesRepository $ratesRepository)
    {

    }

    public function store(): int
    {
        return $this->ratesRepository->save($this->anyApiClient->get());
    }
}
