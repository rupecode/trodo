<?php

namespace App\Http\Controllers\Api;

use App\Dto\CurrenciesResponseDto;
use App\Dto\RateResponseDto;
use App\Factories\PaginatedFactory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Tron\Dto\Address;

class DummyDataController extends Controller
{
    /**
     * @return Address[]
     */
    public function rates(Request $request): array
    {
        $page = (int)$request->get('page', 0);

        $data = [
        ];

        if ($page === 0) {
            $data = [
                new RateResponseDto(1, '16.04.2023', 1.0987),
                new RateResponseDto(2, '15.04.2023', 1.1103),
                new RateResponseDto(3, '14.04.2023', 1.1094),
            ];
        }

        if ($page === 1) {
            $data = [
                new RateResponseDto(4, '13.04.2023', 1.0887),
                new RateResponseDto(5, '12.04.2023', 1.1203),
                new RateResponseDto(6, '11.04.2023', 1.1194),
            ];
        }

        return (new PaginatedFactory())->create(
            20,
            new CurrenciesResponseDto(
                '17.04.2023',
                0.97504,
                1.1103,
                'USD',
                1.0587,
                $data
            )
        );
    }

    public function getAddress(string $id): Address
    {
        return new Address(
            '5a92c2ed-f5a3-448e-8e2f-8e3f89bb1d3f',
            'public-key3',
            'address-base58-3',
            'address-hex-3',
            'hex3',
            3);
    }
}
