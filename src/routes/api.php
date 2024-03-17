<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\DummyDataController;
use App\Http\Controllers\Api\RatesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', [ApiController::class, 'root']);

//Route::get('/currencies', [DummyDataController::class, 'rates']);

Route::get('/currencies', [RatesController::class, 'rates']);

