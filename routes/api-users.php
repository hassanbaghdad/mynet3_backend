<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Users\users_controller;

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


Route::middleware(['auth:sanctum','api'])->get('get-users',[users_controller::class,'get_users']);
Route::middleware(['auth:sanctum','api'])->post('add-user',[users_controller::class,'add_user']);
Route::middleware(['auth:sanctum','api'])->post('edit-user',[users_controller::class,'edit_user']);
Route::middleware(['auth:sanctum','api'])->post('delete-user',[users_controller::class,'delete_user']);
