<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Home\HomeController;
use App\Http\Controllers\AuthController;

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
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['ceklogin'])->group(function () {
    // jika get (/) tidak terdetek dan keluar error tidak suport route
    // check htaccess samakan infocovid comment yang authorize dll

    Route::get('/dashboard', [HomeController::class, 'index'])->name('home.index');
    Route::get('/query', [HomeController::class, 'query'])->name('home.query');
});

Auth::routes();
