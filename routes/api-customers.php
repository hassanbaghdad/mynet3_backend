<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Customers\customers_controller;

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


Route::middleware(['auth:sanctum','api'])->get('get-customers',[customers_controller::class,'get_customers']);
Route::middleware(['auth:sanctum','api'])->get('get-customers-speed',[customers_controller::class,'get_customers_speed']);
Route::middleware(['auth:sanctum','api'])->post('get-customer-details',[customers_controller::class,'get_customer_details']);
Route::middleware(['auth:sanctum','api'])->post('add-customer',[customers_controller::class,'add_customer']);
Route::middleware(['auth:sanctum','api'])->post('edit-customer',[customers_controller::class,'edit_customer']);
Route::middleware(['auth:sanctum','api'])->post('delete-customer',[customers_controller::class,'delete_customer']);
Route::middleware(['auth:sanctum','api'])->post('active-net',[customers_controller::class,'active_net']);
Route::middleware(['auth:sanctum','api'])->post('get-customer-debts',[customers_controller::class,'get_customer_debts']);
Route::middleware(['auth:sanctum','api'])->post('add-debt',[customers_controller::class,'add_debt']);
Route::middleware(['auth:sanctum','api'])->post('pay-off',[customers_controller::class,'payoff']);
Route::middleware(['auth:sanctum','api'])->post('get-sands-customer',[customers_controller::class,'get_sands_customer']);
