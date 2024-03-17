<?php

namespace App\Console\Commands;

use App\Services\AnyApiClient\AnyApiService;
use Illuminate\Console\Command;

class AnyApiFetchRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:any-api-fetch-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch rates per daily basis';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /** @var AnyApiService $service */
        $service = app(AnyApiService::class);
        $id = $service->store();

        $this->info("New rates with id {$id} stored in database.");
    }
}
