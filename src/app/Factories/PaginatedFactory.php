<?php

namespace App\Factories;

class PaginatedFactory
{
    public function create(int $total, mixed $data): array
    {
        $perPage = 5;
        $pageCount = ceil($total / $perPage);

        return [
            'total' => $total,
            'pageCount' => $pageCount,
            'data' => $data,
        ];
    }
}
