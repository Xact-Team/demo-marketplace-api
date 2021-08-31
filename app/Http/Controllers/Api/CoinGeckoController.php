<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Service\CoinGeckoService;
use Illuminate\Http\Request;

class CoinGeckoController extends Controller
{
    public function __invoke(Request $request, CoinGeckoService $geckoService): array
    {
        return $geckoService->getUsdValueFor($request->coin);
    }
}
