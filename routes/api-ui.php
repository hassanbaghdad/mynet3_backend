<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Ui\ui_controller;

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


Route::middleware(['auth:sanctum','api'])->post('save-ui-customers',[ui_controller::class,'save_ui_customers']);
Route::middleware(['auth:sanctum','api'])->get('get-ui-customers',[ui_controller::class,'get_ui_customers']);

Route::middleware(['auth:sanctum','api'])->post('save-ui-towers',[ui_controller::class,'save_ui_towers']);
Route::middleware(['auth:sanctum','api'])->get('get-ui-towers',[ui_controller::class,'get_ui_towers']);

Route::middleware(['auth:sanctum','api'])->post('save-ui-cards',[ui_controller::class,'save_ui_cards']);
Route::middleware(['auth:sanctum','api'])->get('get-ui-cards',[ui_controller::class,'get_ui_cards']);

Route::middleware(['auth:sanctum','api'])->post('save-ui-bills',[ui_controller::class,'save_ui_bills']);
Route::middleware(['auth:sanctum','api'])->get('get-ui-bills',[ui_controller::class,'get_ui_bills']);

Route::middleware(['auth:sanctum','api'])->post('save-ui-users',[ui_controller::class,'save_ui_users']);
Route::middleware(['auth:sanctum','api'])->get('get-ui-users',[ui_controller::class,'get_ui_users']);

Route::middleware(['auth:sanctum','api'])->post('save-ui-debts-to-us',[ui_controller::class,'save_ui_debts_to_us']);
Route::middleware(['auth:sanctum','api'])->get('get-ui-debts-to-us',[ui_controller::class,'get_ui_debts_to_us']);

Route::middleware(['auth:sanctum','api'])->post('save-ui-debts-to-them',[ui_controller::class,'save_ui_debts_to_them']);
Route::middleware(['auth:sanctum','api'])->get('get-ui-debts-to-them',[ui_controller::class,'get_ui_debts_to_them']);

Route::middleware(['auth:sanctum','api'])->post('save-ui-credits',[ui_controller::class,'save_ui_credits']);
Route::middleware(['auth:sanctum','api'])->get('get-ui-credits',[ui_controller::class,'get_ui_credits']);


