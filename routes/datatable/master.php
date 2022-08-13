<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Datatables\Master\WebServiceDatatable;
use App\Http\Controllers\Datatables\Master\KategoriVariabelSurveyDatatable;
use App\Http\Controllers\Datatables\Master\VariabelSurveyDatatable;


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
    Route::post('web-service-datatable', WebServiceDatatable::class)->name('web-service.datatable');
    Route::post('kategori-variabel-survey-datatable', KategoriVariabelSurveyDatatable::class)->name('kategori-variabel-survey.datatable');
    Route::post('variabel-survey-datatable', VariabelSurveyDatatable::class)->name('variabel-survey.datatable');

});
