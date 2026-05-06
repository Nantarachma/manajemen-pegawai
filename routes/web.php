<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuditLogController;

// Auth Routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [PegawaiController::class, 'dashboard'])->name('dashboard');

    // Pegawai CRUD
    Route::resource('pegawai', PegawaiController::class);

    // Import & Export
    Route::get('/pegawai-export', [PegawaiController::class, 'exportPreview'])->name('pegawai.export.preview');
    Route::get('/pegawai-export/download', [PegawaiController::class, 'export'])->name('pegawai.export');
    Route::get('/pegawai-import', [PegawaiController::class, 'importForm'])->name('pegawai.import.form');
    Route::post('/pegawai-import', [PegawaiController::class, 'import'])->name('pegawai.import');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Audit Log
    Route::get('/audit-log', [AuditLogController::class, 'index'])->name('audit.index');
});
