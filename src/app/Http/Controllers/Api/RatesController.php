<?php

namespace App\Http\Controllers\Api;

use App\Enums\Currency;
use App\Enums\Sort;
use App\Services\RatesService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class RatesController extends Controller
{
    public function rates(Request $request, RatesService $ratesService): array
    {
        $page = (int)$request->get('page', 0);
        $currency = $request->get('currency', 0);
        $sort = $request->get('dateSort', 0);

        return $ratesService->rates($page, Currency::from($currency), Sort::from($sort));
    }
}
