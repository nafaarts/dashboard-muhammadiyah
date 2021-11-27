<?php

use App\Http\Controllers\DonasiController;
use App\Http\Controllers\DonasiKategoriController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\StaffController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['token'])->group(function () {
    Route::get('informasi', [InformasiController::class, 'index']);
    Route::post('informasi', [InformasiController::class, 'store']);
    Route::get('informasi/{slug}', [InformasiController::class, 'show']);
    // Route::put('informasi/{id}', [InformasiController::class, 'update']);
    // Route::delete('informasi/{id}', [InformasiController::class, 'destroy']);

    Route::get('kategori', [KategoriController::class, 'index']);
    // Route::post('kategori', [KategoriController::class, 'store']);
    Route::get('kategori/{id}', [KategoriController::class, 'show']);
    Route::put('kategori/{id}', [KategoriController::class, 'update']);
    Route::delete('kategori/{id}', [KategoriController::class, 'destroy']);

    Route::get('staff', [StaffController::class, 'index']);
    Route::post('staff', [StaffController::class, 'store']);
    Route::get('staff/{id}', [StaffController::class, 'show']);
    Route::put('staff/{id}', [StaffController::class, 'update']);
    Route::delete('staff/{id}', [StaffController::class, 'destroy']);

    Route::get('gallery', [GalleryController::class, 'index']);
    Route::post('gallery', [GalleryController::class, 'store']);
    Route::get('gallery/{id}', [GalleryController::class, 'show']);
    Route::put('gallery/{id}', [GalleryController::class, 'update']);
    Route::delete('gallery/{id}', [GalleryController::class, 'destroy']);

    Route::get('kategori-donasi', [DonasiKategoriController::class, 'index']);
    Route::post('kategori-donasi', [DonasiKategoriController::class, 'store']);
    Route::get('kategori-donasi/{id}', [DonasiKategoriController::class, 'show']);
    Route::put('kategori-donasi/{id}', [DonasiKategoriController::class, 'update']);
    Route::delete('kategori-donasi/{id}', [DonasiKategoriController::class, 'destroy']);

    Route::get('donasi', [DonasiController::class, 'index']);
    Route::post('donasi', [DonasiController::class, 'store']);
    Route::get('donasi/{id}', [DonasiController::class, 'show']);
    Route::put('donasi/{id}', [DonasiController::class, 'update']);
    Route::delete('donasi/{id}', [DonasiController::class, 'destroy']);

    Route::get('donatur', [DonaturController::class, 'index']);
    Route::post('donatur', [DonaturController::class, 'store']);
    Route::get('donatur/{id}', [DonaturController::class, 'show']);
    Route::put('donatur/{id}', [DonaturController::class, 'update']);
    Route::delete('donatur/{id}', [DonaturController::class, 'destroy']);
});
