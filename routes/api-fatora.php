<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Items\items_controller;
use App\Http\Controllers\Fatora\fatora_controller;

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

Route::middleware(['auth:sanctum', 'api'])->group(function () {
    Route::post('get-customer-fatora-debts', [fatora_controller::class, 'get_customer_fatora_debts']);
    Route::post('save-fatora', [fatora_controller::class, 'save_fatora']);
    Route::post('delete-sell-fatora', [fatora_controller::class, 'delete_sell_fatora']);
    Route::get('get-sell-foater', [fatora_controller::class, 'get_sell_foater']);
    Route::get('get-fatora-debts-for-us', [fatora_controller::class, 'get_fatora_debts_for_us']);
    Route::get('get-fatora-debts-for-them', [fatora_controller::class, 'get_fatora_debts_for_them']);

});

