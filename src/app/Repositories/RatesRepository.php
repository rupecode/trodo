<?php

namespace App\Repositories;

use App\Enums\Currency;
use App\Enums\Sort;
use App\Models\Rate;
use App\Models\Rates;
use App\Services\AnyApiClient\Dto\AnyApiDto;
use Illuminate\Support\Facades\DB;

class RatesRepository
{
    public function getByCurrency(int $page, Currency $currency, Sort $sort): array
    {
        $perPage = 5;

        $data = Rate::query()
            ->select([DB::raw("SQL_CALC_FOUND_ROWS *")])
            ->where('rates.currency', '=', $currency->name)
            ->join('rates', 'rate.id', '=', 'rates.ratesId')
            ->orderBy('rate.lastUpdate', $sort->name)
            ->forPage($page + 1, $perPage)
            ->get();

        $count = DB::select('SELECT FOUND_ROWS() AS total');

        return ['total' => $count[0]->total, 'data' => $data->toArray()];
    }

    public function getStats(Currency $currency): array
    {
        $data = Rate::query()
            ->select([
                DB::raw(
                    'MAX(rate.lastUpdate) AS lastUpdate,
                    MIN(rates.rate) AS minimum,
                    MAX(rates.rate) AS maximum,
                    AVG(rates.rate) AS average'
                )
            ])
            ->where('rates.currency', '=', $currency->name)
            ->join('rates', 'rate.id', '=', 'rates.ratesId')
            ->get();

        return $data->toArray()[0];
    }

    /**
     * @param AnyApiDto $dto
     * @return int
     * @throws \Throwable
     */
    public function save(AnyApiDto $dto, array $allowedCurrencies): int
    {
        try {
            DB::beginTransaction();

            $count = Rate::query()
                ->where('baseCurrency', '=', $dto->base)
                ->count();

            if ($count > 0) {
                throw new \Exception('Rate exists.');
            }

            $rate = new Rate();
            $rate->lastUpdate = $dto->lastUpdate;
            $rate->baseCurrency = $dto->base;
            $rate->saveOrFail();
            $rate->refresh();

            foreach ($dto->rates as $item) {
                if (!in_array($item->currency, $allowedCurrencies)) {
                    continue;
                }

                $rates = new Rates();
                $rates->ratesId = $rate->id;
                $rates->currency = $item->currency;
                $rates->rate = $item->rate;

                $rates->saveOrFail();
            }

            DB::commit();

            return $rate->id;
        } catch (\Throwable $t) {
            DB::rollback();

            throw $t;
        }
    }
}
