<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Datatables\IndikatorMutu\IndikatorMutuNasionalDatatable;
use App\Http\Controllers\Datatables\IndikatorMutu\IndikatorMutuNasionalHasilDatatable;
use App\Http\Controllers\Datatables\IndikatorMutu\IndikatorMutuLokalDatatable;
use App\Http\Controllers\Datatables\IndikatorMutu\VariabelDatatable;


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
    //Modul Indikator Mutu Nasional
    Route::post('indikator-mutu-nasional-datatable', IndikatorMutuNasionalDatatable::class)->name('indikator-mutu-nasional.datatable');
    Route::post('indikator-mutu-nasional-hasil-datatable', IndikatorMutuNasionalHasilDatatable::class)->name('indikator-mutu-nasional-hasil.datatable');
    // Route::post('indikator-mutu-nasional-kategori-datatable', IndikatorMutuNasionalKategoriDatatable::class)->name('indikator-mutu-nasional-kategori.datatable');

    //Modul Indikator Mutu Lokal
    Route::post('indikator-mutu-lokal-datatable', IndikatorMutuLokalDatatable::class)->name('indikator-mutu-lokal.datatable');

    //Modul Untuk Akses Variabel Semua Indikator Mutu Nasional dan Lokal
    Route::post('variabel-datatable', VariabelDatatable::class)->name('variabel.datatable');
});
