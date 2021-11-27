<?php

use App\Http\Controllers\Page\AuthController;
use App\Http\Controllers\Page\DonasiPageController;
use App\Http\Controllers\Page\DonaturController;
use App\Http\Controllers\Page\GalleryPageController;
use App\Http\Controllers\Page\InformasiPageController;
use App\Http\Controllers\Page\KategoriDonasiController;
use App\Http\Controllers\Page\KategoriInformasiController;
use App\Http\Controllers\Page\ProfileController;
use App\Http\Controllers\Page\StaffController;
use App\Http\Controllers\Page\UsersManagementController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/logout', function () {
        return redirect('/');
    });

    // Dashboard
    Route::get('/', function () {
        return view('index', ['title' => 'Dashboard']);
    })->name('dashboard');

    // Informasi
    Route::get('/informasi', [InformasiPageController::class, 'index'])->name('informasi');
    Route::get('/informasi/create', [InformasiPageController::class, 'create'])->name('informasi.create');
    Route::post('/informasi/create', [InformasiPageController::class, 'store'])->name('informasi.store');
    Route::get('/informasi/edit/{informasi}', [InformasiPageController::class, 'edit'])->name('informasi.edit');
    Route::patch('/informasi/edit/{informasi}', [InformasiPageController::class, 'update'])->name('informasi.edit');
    Route::delete('/informasi/delete/{informasi}', [InformasiPageController::class, 'destroy'])->name('informasi.delete');

    // Donasi
    Route::get('/donasi', [DonasiPageController::class, 'index'])->name('donasi');
    Route::get('/donasi/create', [DonasiPageController::class, 'create'])->name('donasi.create');
    Route::post('/donasi/create', [DonasiPageController::class, 'store'])->name('donasi.store');
    Route::get('/donasi/edit/{donasi}', [DonasiPageController::class, 'edit'])->name('donasi.edit');
    Route::patch('/donasi/edit/{donasi}', [DonasiPageController::class, 'update'])->name('donasi.update');
    Route::delete('/donasi/delete/{donasi}', [DonasiPageController::class, 'destroy'])->name('donasi.delete');

    // Galeri
    Route::get('/galeri', [GalleryPageController::class, 'index'])->name('galeri');
    Route::get('/galeri/create', [GalleryPageController::class, 'create'])->name('galeri.create');
    Route::post('/galeri/create', [GalleryPageController::class, 'store'])->name('galeri.store');
    Route::delete('/galeri/{gallery}', [GalleryPageController::class, 'destroy'])->name('galeri.delete');

    // Admin
    Route::get('/admin-management', [UsersManagementController::class, 'index'])->name('admin');
    Route::get('/admin-management/create', [UsersManagementController::class, 'create'])->name('admin.create');
    Route::post('/admin-management/create', [UsersManagementController::class, 'store'])->name('admin.store');
    Route::get('/admin-management/edit/{admin}', [UsersManagementController::class, 'edit'])->name('admin.edit');
    Route::patch('/admin-management/edit/{admin}', [UsersManagementController::class, 'update'])->name('admin.update');
    Route::delete('/admin-management/delete/{admin}', [UsersManagementController::class, 'destroy'])->name('admin.delete');

    // Staff
    Route::get('/staff', [StaffController::class, 'index'])->name('staff');
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff/create', [StaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/edit/{staff}', [StaffController::class, 'edit'])->name('staff.edit');
    Route::patch('/staff/edit/{staff}', [StaffController::class, 'update'])->name('staff.update');
    Route::delete('/staff/delete/{staff}', [StaffController::class, 'destroy'])->name('staff.delete');

    // Profile
    Route::get('/my-profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('/my-profile/edit', [ProfileController::class, 'update'])->name('profile.update');

    // Kategori Donasi
    Route::get('/kategori-donasi', [KategoriDonasiController::class, 'index'])->name('kategori-donasi');
    Route::post('/kategori-donasi/create', [KategoriDonasiController::class, 'store'])->name('kategori-donasi.store');
    Route::patch('/kategori-donasi/edit', [KategoriDonasiController::class, 'update'])->name('kategori-donasi.update');
    Route::delete('/kategori-donasi/delete/{id}', [KategoriDonasiController::class, 'destroy'])->name('kategori-donasi.delete');

    // Kategori Informasi
    Route::get('/kategori-informasi', [KategoriInformasiController::class, 'index'])->name('kategori-informasi');
    Route::post('/kategori-informasi/create', [KategoriInformasiController::class, 'store'])->name('kategori-informasi.store');
    Route::patch('/kategori-informasi/edit', [KategoriInformasiController::class, 'update'])->name('kategori-informasi.update');
    Route::delete('/kategori-informasi/delete/{id}', [KategoriInformasiController::class, 'destroy'])->name('kategori-informasi.delete');

    Route::get('/donatur/{donasi}', [DonaturController::class, 'index'])->name('donatur');
    Route::get('/donatur/{donasi}/create', [DonaturController::class, 'create'])->name('donatur.create');
    Route::post('/donatur/{donasi}/create', [DonaturController::class, 'store'])->name('donatur.store');
    Route::get('/donatur/{donatur}/edit', [DonaturController::class, 'edit'])->name('donatur.edit');
    Route::patch('/donatur/{donatur}/edit', [DonaturController::class, 'update'])->name('donatur.update');
    Route::delete('/donatur/{donatur}/delete', [DonaturController::class, 'destroy'])->name('donatur.delete');
});
