<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Form\RegistrasiAntrianIgdController;

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
    // Form
    Route::group(['prefix' => 'registrasi-antrian-igd'], function () {
        Route::get('/', [RegistrasiAntrianIgdController::class, 'index'])->name('registrasi-antrian-igd.index');
        Route::post('store', [RegistrasiAntrianIgdController::class, 'store'])->name('registrasi-antrian-igd.store');
        Route::post('edit', [RegistrasiAntrianIgdController::class, 'edit'])->name('registrasi-antrian-igd.edit');
        Route::post('store-waktu', [RegistrasiAntrianIgdController::class, 'storeWaktu'])->name('registrasi-antrian-igd.store-waktu');
        Route::post('edit-waktu', [RegistrasiAntrianIgdController::class, 'editWaktu'])->name('registrasi-antrian-igd.edit-waktu');
        Route::post('{tanggal}/{panggil}/{layani}/export', [RegistrasiAntrianIgdController::class, 'export'])->name('registrasi-antrian-igd.export');
    });


});
