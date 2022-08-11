<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Monitoring\MonitoringPasienController;
use App\Http\Controllers\Web\Monitoring\MonitoringPasien\KepatuhanIdentifikasiPasienController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. Thesey
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware([])->group(function () {
    //Route Data Service
    Route::group(['prefix' => 'monitoring-pasien'], function () {
        Route::get('/', [MonitoringPasienController::class, 'index'])->name('monitoring-pasien.index');
    });

    Route::group(['prefix' => 'kepatuhan-identifikasi'], function () {
        Route::get('/', [KepatuhanIdentifikasiPasienController::class, 'index'])->name('kepatuhan-identifikasi.index');
    });

});
