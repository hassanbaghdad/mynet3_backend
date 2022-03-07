<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Sand\sand_controller;
use App\Http\Controllers\Debts\debts_controller;

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


Route::middleware(['auth:sanctum','api'])->get('get-bills',[sand_controller::class,'get_bills']);

Route::middleware(['auth:sanctum','api'])->post('delete-bill',[sand_controller::class,'delete_bill']);

Route::middleware(['auth:sanctum','api'])->get('get-debts-to-us',[debts_controller::class,'get_debts_to_us']);

Route::middleware(['auth:sanctum','api'])->get('get-debts-to-them',[debts_controller::class,'get_debts_to_them']);

Route::middleware(['auth:sanctum','api'])->get('get-credits-di',[debts_controller::class,'get_credits_di']);

Route::middleware(['auth:sanctum','api'])->get('get-credits-do',[debts_controller::class,'get_credits_do']);




