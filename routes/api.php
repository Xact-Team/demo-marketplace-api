<?php

use App\Http\Controllers\Api\CoinGeckoController;
use App\Http\Controllers\Api\NftController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('coingecko/get-usd-value-for', CoinGeckoController::class);

Route::resource('nft', NftController::class)->only('index', 'store', 'show');
Route::resource('middleman/orders', OrderController::class)->only('index', 'store', 'update');
