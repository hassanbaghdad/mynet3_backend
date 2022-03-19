<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Cards\cards_controller;

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

Route::middleware(['auth:sanctum', 'api','owner_mid'])->group(function () {
    Route::get('get-cards', [cards_controller::class, 'get_cards']);
    Route::post('add-card', [cards_controller::class, 'add_card']);
    Route::post('edit-card', [cards_controller::class, 'edit_card']);
    Route::post('delete-card', [cards_controller::class, 'delete_card']);
});

