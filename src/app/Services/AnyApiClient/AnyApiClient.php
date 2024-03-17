<?php

namespace App\Services\AnyApiClient;

use App\Services\AnyApiClient\Dto\AnyApiDto;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class AnyApiClient
{
    private string $apiKey;

    private string $baseUrl;
    private string $ratesUrl;

    public function __construct(private AnyApiResponseFactory $anyApiResponseFactory)
    {
        $this->baseUrl = config('anyapi.base_url');
        $this->ratesUrl = config('anyapi.rates_url');
        $this->apiKey = config('anyapi.api_key');
    }

    /**
     * @return AnyApiDto
     * @throws RequestException
     */
    public function get(): AnyApiDto
    {
        $response = Http::get($this->baseUrl . $this->ratesUrl, ['apiKey' => $this->apiKey])->throwIfServerError();

        return $this->anyApiResponseFactory->fromString($response->getBody()->getContents());
    }
}
