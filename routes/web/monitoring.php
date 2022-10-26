<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Monitoring\MonitoringPasienController;
use App\Http\Controllers\Web\Monitoring\AnthropometricController;
use App\Http\Controllers\Web\Monitoring\MonitoringPasien\KepatuhanIdentifikasiPasienController;
use App\Http\Controllers\Web\Monitoring\MonitoringPasien\EmergencyResponTimeController;
use App\Http\Controllers\Web\Monitoring\MonitoringPasien\WaktuTungguRawatJalanController;
use App\Http\Controllers\Web\Monitoring\MonitoringPasien\PenundaanOperasiElektifController;

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
    //Route Anthropometric
    Route::group(['prefix' => 'anthropometric'], function () {
        Route::get('/', [AnthropometricController::class, 'index'])->name('anthropometric.index');
        Route::post('store', [AnthropometricController::class, 'store'])->name('anthropometric.store');
        Route::put('{id}/update', [AnthropometricController::class, 'update'])->name('anthropometric.update');
        Route::get('{id}/edit', [AnthropometricController::class, 'edit'])->name('anthropometric.edit');
        Route::delete('{id}/destroy', [AnthropometricController::class, 'destroy'])->name('anthropometric.destroy');
    });

    //Route Data Service
    Route::group(['prefix' => 'monitoring-pasien'], function () {
        Route::get('/', [MonitoringPasienController::class, 'index'])->name('monitoring-pasien.index');
    });

    //Filter
    Route::post('filter-bagian', [MonitoringPasienController::class, 'filterBagian'])->name('monitoring-pasien.filter-bagian');

    Route::group(['prefix' => 'kepatuhan-identifikasi'], function () {
        Route::post('/', [KepatuhanIdentifikasiPasienController::class, 'store'])->name('kepatuhan-identifikasi.store');
        Route::put('{id}/update', [KepatuhanIdentifikasiPasienController::class, 'update'])->name('kepatuhan-identifikasi.update');
    });

    Route::group(['prefix' => 'emergency-respon-time'], function () {
        Route::post('/', [EmergencyResponTimeController::class, 'store'])->name('emergency-respon-time.store');
        Route::put('{id}/update', [EmergencyResponTimeController::class, 'update'])->name('emergency-respon-time.update');
    });


    Route::group(['prefix' => 'waktu-tunggu-rawat-jalan'], function () {
        Route::post('/', [WaktuTungguRawatJalanController::class, 'store'])->name('waktu-tunggu-rawat-jalan.store');
        Route::put('{id}/update', [WaktuTungguRawatJalanController::class, 'update'])->name('waktu-tunggu-rawat-jalan.update');
    });

    Route::group(['prefix' => 'penundaan-operasi-elektif'], function () {
        Route::post('/', [PenundaanOperasiElektifController::class, 'store'])->name('penundaan-operasi-elektif.store');
        Route::put('{id}/update', [PenundaanOperasiElektifController::class, 'update'])->name('penundaan-operasi-elektif.update');
    });

});
