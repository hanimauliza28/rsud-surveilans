<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Setting\MenuController;
use App\Http\Controllers\Web\Setting\UserController;
use App\Http\Controllers\Web\Setting\PengumumanController;
use App\Http\Controllers\Web\Setting\GrupUserController;

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

    Route::group(['prefix' => 'grup-user'], function () {
        Route::get('/', [GrupUserController::class, 'index'])->name('grup-user.index');
        Route::post('store', [GrupUserController::class, 'store'])->name('grup-user.store');
        Route::get('{id}/view', [GrupUserController::class, 'view'])->name('grup-user.view');
        Route::get('{id}/edit', [GrupUserController::class, 'edit'])->name('grup-user.edit');
        Route::put('{id}/update', [GrupUserController::class, 'update'])->name('grup-user.update');
        Route::delete('{id}/destroy', [GrupUserController::class, 'destroy'])->name('grup-user.destroy');
        Route::post('pilihan-bagian', [GrupUserController::class, 'pilihanBagian'])->name('grup-user.pilihan-bagian');
        Route::post('hak-akses', [GrupUserController::class, 'hakAkses'])->name('grup-user.hak-akses');
    });

    Route::group(['prefix' => 'pengumuman'], function () {
        Route::get('/', [PengumumanController::class, 'index'])->name('pengumuman.index');
        Route::post('store', [PengumumanController::class, 'store'])->name('pengumuman.store');
        Route::get('{id}/show', [PengumumanController::class, 'show'])->name('pengumuman.show');
        Route::get('{id}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
        Route::put('{id}/update', [PengumumanController::class, 'update'])->name('pengumuman.update');
        Route::delete('{id}/destroy', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');
        Route::put('{id}/update-status', [PengumumanController::class, 'updateStatus'])->name('pengumuman.update-status');
    });

});
