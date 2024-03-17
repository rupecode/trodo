<?php

namespace Database\Seeders;

use App\Models\Rate;
use App\Models\Rates;
use Illuminate\Database\Seeder;

class DummyRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 20; $i++) {
            $this->store($i);
        }
    }

    private function store($day): void
    {
        $rate = new Rate();
        $rate->baseCurrency = 'EUR';
        $rate->lastUpdate = strtotime("-$day day");
        $rate->saveOrFail();
        $rate->refresh();

        $rates = new Rates();
        $rates->ratesId = $rate->id;
        $rates->currency = 'GBP';
        $rates->rate = 0.851;
        $rates->saveOrFail();

        $rates = new Rates();
        $rates->ratesId = $rate->id;
        $rates->currency = 'USD';
        $rates->rate = 1.1;
        $rates->saveOrFail();

        $rates = new Rates();
        $rates->ratesId = $rate->id;
        $rates->currency = 'AUD';
        $rates->rate = 1.65;
        $rates->saveOrFail();
    }
}
