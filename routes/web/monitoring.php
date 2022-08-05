<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Monitoring\MonitoringController;

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
    Route::group(['prefix' => 'monitoring'], function () {
        Route::get('/', [MonitoringController::class, 'index'])->name('monitoring.index');

    });

});
