<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backups\backups_controller;
use App\Http\Controllers\Settings\settings_controller;

use Illuminate\Database\Eloquent\Model;
use Spatie\Multitenancy\Actions\ForgetCurrentTenantAction;
use Spatie\Multitenancy\Actions\MakeTenantCurrentAction;
use Spatie\Multitenancy\Concerns\UsesMultitenancyConfig;
use Spatie\Multitenancy\Models\Concerns\UsesLandlordConnection;
use Spatie\Multitenancy\Models\Tenant;
use Spatie\Multitenancy\TenantCollection;


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


Route::prefix('auth')->middleware(['tenant','api'])->group(function() {

        Route::middleware('api')->post('/login',[AuthController::class,'login']);
        Route::middleware('api')->post('/login2',[AuthController::class,'login2']);
        Route::middleware(['auth:sanctum','api'])->get('logout',[AuthController::class,'logout']);
Route::middleware(['auth:sanctum','api'])->get('get-backups',[backups_controller::class,'get_backups']);
Route::middleware(['auth:sanctum','api'])->get('create-backup',[backups_controller::class,'create_backup']);
Route::middleware(['auth:sanctum','api'])->post('delete-backup',[backups_controller::class,'delete_backup']);
Route::middleware(['auth:sanctum','api'])->get('get-settings',[settings_controller::class,'get_settings']);
Route::middleware(['auth:sanctum','api'])->post('save-settings',[settings_controller::class,'save_settings']);


});

Route::middleware('auth:sanctum')->get('/backup-database', function (Request $request) {


    \Illuminate\Support\Facades\Artisan::call('backup:database');
    return response()->download(storage_path('app/backups/'.Tenant::current()->name.'/backup.sql'));
});

