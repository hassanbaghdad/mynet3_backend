<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Towers\towers_controller;

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
    Route::get('get-towers', [towers_controller::class, 'get_towers']);
    Route::post('add-tower', [towers_controller::class, 'add_tower']);
    Route::post('edit-tower', [towers_controller::class, 'edit_tower']);
    Route::post('delete-tower', [towers_controller::class, 'delete_tower']);
});

