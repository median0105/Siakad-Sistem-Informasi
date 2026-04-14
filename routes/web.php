<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\DosenController as AdminDosenController;
use App\Http\Controllers\Admin\KelasController as AdminKelasController;
use App\Http\Controllers\Admin\MahasiswaController as AdminMahasiswaController;
use App\Http\Controllers\Admin\MataKuliahController as AdminMataKuliahController;
use App\Http\Controllers\Dosen\DashboardController as DosenDashboardController;
use App\Http\Controllers\Mahasiswa\KrsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardController::class)
    ->middleware('auth')
    ->name('dashboard');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');

        Route::resource('mata-kuliah', AdminMataKuliahController::class)
            ->parameters(['mata-kuliah' => 'mataKuliah'])
            ->except(['show']);
        Route::resource('dosen', AdminDosenController::class)
            ->except(['show']);
        Route::resource('kelas', AdminKelasController::class)
            ->except(['show']);
        Route::resource('mahasiswa', AdminMahasiswaController::class)
            ->parameters(['mahasiswa' => 'user'])
            ->except(['show']);
    });

Route::prefix('mahasiswa')
    ->name('mahasiswa.')
    ->middleware(['auth', 'role:mahasiswa'])
    ->group(function () {
        Route::view('/dashboard', 'mahasiswa.dashboard')->name('dashboard');
        Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
        Route::post('/krs/{kelas}', [KrsController::class, 'store'])->name('krs.store');
        Route::delete('/krs/{kelas}', [KrsController::class, 'destroy'])->name('krs.destroy');
    });

Route::prefix('dosen')
    ->name('dosen.')
    ->middleware(['auth', 'role:dosen'])
    ->group(function () {
        Route::get('/dashboard', DosenDashboardController::class)->name('dashboard');
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
