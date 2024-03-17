<?php

namespace App\Services\AnyApiClient;

use App\Services\AnyApiClient\Dto\AnyApiDto;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class AnyApiClient
{
    private string $uri;
    private string $apiKey;

    public function __construct(private AnyApiResponseFactory $anyApiResponseFactory)
    {
        $this->uri = 'https://anyapi.io/api/v1/exchange/rates';
        $this->apiKey = 'vkruc29ccuogqr2qpq1j9ofucas21im4p518co6ouc7di8u6rtv18';
    }

    /**
     * @return AnyApiDto
     * @throws RequestException
     */
    public function get(): AnyApiDto
    {
        $response = Http::get($this->uri, ['apiKey' => $this->apiKey])->throwIfServerError();

        return $this->anyApiResponseFactory->fromString($response->getBody()->getContents());
    }
}
