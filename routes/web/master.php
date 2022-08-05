<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Master\WebServiceController;

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

});
