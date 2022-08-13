<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Master\WebServiceController;
use App\Http\Controllers\Web\Master\KategoriVariabelSurveyController;
use App\Http\Controllers\Web\Master\VariabelSurveyController;

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
    //Route Data Service
    Route::group(['prefix' => 'web-service'], function () {
        Route::get('/', [WebServiceController::class, 'index'])->name('web-service.index');
        Route::post('store', [WebServiceController::class, 'store'])->name('web-service.store');
        Route::get('{id}/view', [WebServiceController::class, 'view'])->name('web-service.view');
        Route::get('{id}/edit', [WebServiceController::class, 'edit'])->name('web-service.edit');
        Route::put('{id}/update', [WebServiceController::class, 'update'])->name('web-service.update');
        Route::delete('{id}/destroy', [WebServiceController::class, 'destroy'])->name('web-service.destroy');

    });

    //Route Kategori Kategori Survey
    Route::group(['prefix' => 'kategori-variabel-survey'], function () {
        Route::get('/', [KategoriVariabelSurveyController::class, 'index'])->name('kategori-variabel-survey.index');
        Route::post('store', [KategoriVariabelSurveyController::class, 'store'])->name('kategori-variabel-survey.store');
        Route::get('{id}/view', [KategoriVariabelSurveyController::class, 'view'])->name('kategori-variabel-survey.view');
        Route::get('{id}/edit', [KategoriVariabelSurveyController::class, 'edit'])->name('kategori-variabel-survey.edit');
        Route::put('{id}/update', [KategoriVariabelSurveyController::class, 'update'])->name('kategori-variabel-survey.update');
        Route::delete('{id}/destroy', [KategoriVariabelSurveyController::class, 'destroy'])->name('kategori-variabel-survey.destroy');
    });


    //Route Variabel Survey
    Route::group(['prefix' => 'variabel-survey'], function () {
        Route::get('/', [VariabelSurveyController::class, 'index'])->name('variabel-survey.index');
        Route::post('store', [VariabelSurveyController::class, 'store'])->name('variabel-survey.store');
        Route::get('{id}/view', [VariabelSurveyController::class, 'view'])->name('variabel-survey.view');
        Route::get('{id}/edit', [VariabelSurveyController::class, 'edit'])->name('variabel-survey.edit');
        Route::put('{id}/update', [VariabelSurveyController::class, 'update'])->name('variabel-survey.update');
        Route::delete('{id}/destroy', [VariabelSurveyController::class, 'destroy'])->name('variabel-survey.destroy');
    });

});
