<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;

Route::get('/', [PegawaiController::class, 'dashboard'])->name('dashboard');
Route::resource('pegawai', PegawaiController::class);
