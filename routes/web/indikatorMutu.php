<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\IndikatorMutu\IndikatorMutuNasionalController;
use App\Http\Controllers\Web\IndikatorMutu\IndikatorMutuLokalController;
use App\Http\Controllers\Web\IndikatorMutu\IndikatorMutuNasionalWajibController;
use App\Http\Controllers\Web\IndikatorMutu\IndikatorMutuNasionalManajemenController;
use App\Http\Controllers\Web\IndikatorMutu\IndikatorMutuNasionalKlinikController;
use App\Http\Controllers\Web\IndikatorMutu\VariabelController;

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

Route::middleware([])->group(function () {
    //Route Indikator Mutu Nasional
    Route::group(['prefix' => 'indikator-mutu-nasional'], function () {
        Route::get('/', [IndikatorMutuNasionalController::class, 'index'])->name('indikator-mutu-nasional.index');
        Route::post('store', [IndikatorMutuNasionalController::class, 'store'])->name('indikator-mutu-nasional.store');
        Route::get('{id}/view', [IndikatorMutuNasionalController::class, 'view'])->name('indikator-mutu-nasional.view');
        Route::get('{id}/edit', [IndikatorMutuNasionalController::class, 'edit'])->name('indikator-mutu-nasional.edit');
        Route::put('{id}/update', [IndikatorMutuNasionalController::class, 'update'])->name('indikator-mutu-nasional.update');
        Route::delete('{id}/destroy', [IndikatorMutuNasionalController::class, 'destroy'])->name('indikator-mutu-nasional.destroy');
    });

    //Route Indikator Mutu Nasional Wajib
    Route::group(['prefix' => 'indikator-mutu-nasional-wajib'], function () {
        Route::get('/', [IndikatorMutuNasionalWajibController::class, 'index'])->name('indikator-mutu-nasional-wajib.index');
        Route::post('store', [IndikatorMutuNasionalWajibController::class, 'store'])->name('indikator-mutu-nasional-wajib.store');
        Route::get('{id}/view', [IndikatorMutuNasionalWajibController::class, 'view'])->name('indikator-mutu-nasional-wajib.view');
        Route::get('{id}/edit', [IndikatorMutuNasionalWajibController::class, 'edit'])->name('indikator-mutu-nasional-wajib.edit');
        Route::put('{id}/update', [IndikatorMutuNasionalWajibController::class, 'update'])->name('indikator-mutu-nasional-wajib.update');
        Route::delete('{id}/destroy', [IndikatorMutuNasionalWajibController::class, 'destroy'])->name('indikator-mutu-nasional-wajib.destroy');

        Route::post('{id}/variabel', [IndikatorMutuNasionalWajibController::class, 'variabel'])->name('indikator-mutu-nasional-wajib.variabel');
        Route::post('store-nilai', [IndikatorMutuNasionalWajibController::class, 'storeNilai'])->name('indikator-mutu-nasional-wajib.storeNilai');
    });

    //Route Indikator Mutu Nasional Klinik
    Route::group(['prefix' => 'indikator-mutu-nasional-klinik'], function () {
        Route::get('/', [IndikatorMutuNasionalKlinikController::class, 'index'])->name('indikator-mutu-nasional-klinik.index');
        Route::post('store', [IndikatorMutuNasionalKlinikController::class, 'store'])->name('indikator-mutu-nasional-klinik.store');
        Route::get('{id}/view', [IndikatorMutuNasionalKlinikController::class, 'view'])->name('indikator-mutu-nasional-klinik.view');
        Route::get('{id}/edit', [IndikatorMutuNasionalKlinikController::class, 'edit'])->name('indikator-mutu-nasional-klinik.edit');
        Route::put('{id}/update', [IndikatorMutuNasionalKlinikController::class, 'update'])->name('indikator-mutu-nasional-klinik.update');
        Route::delete('{id}/destroy', [IndikatorMutuNasionalKlinikController::class, 'destroy'])->name('indikator-mutu-nasional-klinik.destroy');

        Route::post('{id}/variabel', [IndikatorMutuNasionalKlinikController::class, 'variabel'])->name('indikator-mutu-nasional-klinik.variabel');
        Route::post('store-nilai', [IndikatorMutuNasionalKlinikController::class, 'storeNilai'])->name('indikator-mutu-nasional-klinik.storeNilai');
    });

    //Route Indikator Mutu Nasional Manajemen
    Route::group(['prefix' => 'indikator-mutu-nasional-manajemen'], function () {
        Route::get('/', [IndikatorMutuNasionalManajemenController::class, 'index'])->name('indikator-mutu-nasional-manajemen.index');
        Route::post('store', [IndikatorMutuNasionalManajemenController::class, 'store'])->name('indikator-mutu-nasional-manajemen.store');
        Route::get('{id}/view', [IndikatorMutuNasionalManajemenController::class, 'view'])->name('indikator-mutu-nasional-manajemen.view');
        Route::get('{id}/edit', [IndikatorMutuNasionalManajemenController::class, 'edit'])->name('indikator-mutu-nasional-manajemen.edit');
        Route::put('{id}/update', [IndikatorMutuNasionalManajemenController::class, 'update'])->name('indikator-mutu-nasional-manajemen.update');
        Route::delete('{id}/destroy', [IndikatorMutuNasionalManajemenController::class, 'destroy'])->name('indikator-mutu-nasional-manajemen.destroy');

        Route::post('{id}/variabel', [IndikatorMutuNasionalManajemenController::class, 'variabel'])->name('indikator-mutu-nasional-manajemen.variabel');
        Route::post('store-nilai', [IndikatorMutuNasionalManajemenController::class, 'storeNilai'])->name('indikator-mutu-nasional-manajemen.storeNilai');
    });

    //Route Indikator Mutu Lokal
    Route::group(['prefix' => 'indikator-mutu-lokal'], function () {
        Route::get('/', [IndikatorMutuLokalController::class, 'index'])->name('indikator-mutu-lokal.index');
        Route::get('{id}/view', [IndikatorMutuLokalController::class, 'view'])->name('indikator-mutu-lokal.view');
        Route::post('store', [IndikatorMutuLokalController::class, 'store'])->name('indikator-mutu-lokal.store');
        Route::get('{id}/edit', [IndikatorMutuLokalController::class, 'edit'])->name('indikator-mutu-lokal.edit');
        Route::put('{id}/update', [IndikatorMutuLokalController::class, 'update'])->name('indikator-mutu-lokal.update');
        Route::delete('{id}/destroy', [IndikatorMutuLokalController::class, 'destroy'])->name('indikator-mutu-lokal.destroy');
    });

    //Route Variabel
    Route::group(['prefix' => 'variabel'], function () {
        Route::get('/', [VariabelController::class, 'index'])->name('variabel.index');
        Route::post('store', [VariabelController::class, 'store'])->name('variabel.store');
        Route::get('{id}/edit', [VariabelController::class, 'edit'])->name('variabel.edit');
        Route::put('{id}/update', [VariabelController::class, 'update'])->name('variabel.update');
        Route::delete('{id}/destroy', [VariabelController::class, 'destroy'])->name('variabel.destroy');
    });

});
