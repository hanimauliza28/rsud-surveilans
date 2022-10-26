<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Datatables\Monitoring\AnthropometricDatatable;


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
    //Modul Data Pasien
    Route::post('anthropometric-datatable', AnthropometricDatatable::class)->name('anthropometric.datatable');

});
