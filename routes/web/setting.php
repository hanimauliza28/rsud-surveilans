<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Setting\MenuController;
use App\Http\Controllers\Web\Setting\UserController;

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

Route::middleware(['ceklogin'])->group(function () {

    // Menu
    Route::group(['prefix' => 'setting-menu'], function () {
        Route::get('/', [MenuController::class, 'index'])->name('setting-menu.index');
        Route::post('store', [MenuController::class, 'store'])->name('setting-menu.store');
        Route::get('{id}/view', [MenuController::class, 'view'])->name('setting-menu.view');
        Route::get('{id}/edit', [MenuController::class, 'edit'])->name('setting-menu.edit');
        Route::put('{id}/update', [MenuController::class, 'update'])->name('setting-menu.update');
        Route::delete('{id}/destroy', [MenuController::class, 'destroy'])->name('setting-menu.destroy');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::post('store', [UserController::class, 'store'])->name('user.store');
        Route::get('{id}/view', [UserController::class, 'view'])->name('user.view');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('{id}/update', [UserController::class, 'update'])->name('user.update');
        Route::delete('{id}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
    });

});
