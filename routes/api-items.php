<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Items\items_controller;

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
    Route::get('get-items', [items_controller::class, 'get_items']);
    Route::post('add-item', [items_controller::class, 'add_item']);
    Route::post('edit-item', [items_controller::class, 'edit_item']);
    Route::post('delete-item', [items_controller::class, 'delete_item']);

});

