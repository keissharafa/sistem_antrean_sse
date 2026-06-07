<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AntrianController;

Route::get('/guest', [AntrianController::class, 'guest'])->name('guest');
Route::post('/guest/daftar', [AntrianController::class, 'daftar'])->name('guest.daftar');
Route::get('/guest/nomor/{id}', [AntrianController::class, 'nomor'])->name('guest.nomor');

Route::get('/admin', [AntrianController::class, 'admin'])->name('admin');

Route::post('/admin/panggil-berikutnya', [AntrianController::class, 'panggilBerikutnya'])
    ->name('admin.panggilBerikutnya');
Route::post('/admin/terlambat/{id}', [AntrianController::class, 'tandaiTerlambat'])
    ->name('admin.terlambat');
Route::post('/admin/panggil-terlambat/{id}', [AntrianController::class, 'panggilTerlambat'])
    ->name('admin.panggilTerlambat');