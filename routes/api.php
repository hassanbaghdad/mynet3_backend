<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('api')->post('/login',[AuthController::class,'login']);
Route::middleware(['auth:sanctum','api'])->get('logout',[AuthController::class,'logout']);

Route::middleware('auth:sanctum')->get('/backup-database', function (Request $request) {
    \Illuminate\Support\Facades\Artisan::call('backup:database');
    return response()->download(storage_path('app/backups/backup.sql'));
});

