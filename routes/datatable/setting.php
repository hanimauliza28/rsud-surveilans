<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Datatables\Setting\MenuDatatable;
use App\Http\Controllers\Datatables\Setting\UserDatatable;


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

Route::middleware(['ceklogin'])->group(function () {

    Route::post('setting-menu-datatable', MenuDatatable::class)->name('setting-menu.datatable');
    Route::post('user-datatable', UserDatatable::class)->name('user.datatable');

});
