<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Form\RegistrasiAntrianIgdController;
use App\Http\Controllers\Web\Form\SurveyKepuasanController;

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

        Route::get('export', [RegistrasiAntrianIgdController::class, 'export'])->name('registrasi-antrian-igd.export');
        Route::post('export-excel', [RegistrasiAntrianIgdController::class, 'exportExcel'])->name('registrasi-antrian-igd.export-excel');
        Route::post('statistik', [RegistrasiAntrianIgdController::class, 'statistik'])->name('registrasi-antrian-igd.statistik');
        Route::post('set-triage', [RegistrasiAntrianIgdController::class, 'setTriage'])->name('registrasi-antrian-igd.set-triage');
    });


    Route::group(['prefix' => 'survey-kepuasan'], function () {
        Route::get('/', [SurveyKepuasanController::class, 'index'])->name('survey-kepuasan.index');
        Route::post('store', [SurveyKepuasanController::class, 'store'])->name('survey-kepuasan.store');
        Route::post('edit', [SurveyKepuasanController::class, 'edit'])->name('survey-kepuasan.edit');
    });
});
