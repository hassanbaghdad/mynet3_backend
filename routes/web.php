<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('tenant')->group(function() {
    Route::get('/', function () {
        return view('welcome');
    });
});


Route::get('/backup', function () {
    \Illuminate\Support\Facades\Artisan::call('backup:database');
    return response()->download(storage_path('app/backups/backup.sql'));
});

