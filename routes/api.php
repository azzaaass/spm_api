<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HistoryJabatanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\PenelitianDosenController;
use App\Http\Controllers\PenelitianMahasiswaController;
use App\Http\Controllers\PengabdianController;
use App\Http\Controllers\PengabdianDosenController;
use App\Http\Controllers\PengabdianMahasiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {

        Route::middleware('role:prodi,admin')->group(function () {
            Route::get('/penelitian', [PenelitianController::class, 'index']);
            Route::post('/penelitian', [PenelitianController::class, 'store']);
            Route::get('/penelitian/{penelitian}', [PenelitianController::class, 'show']);
            Route::put('/penelitian/{penelitian}', [PenelitianController::class, 'update']);

            Route::get('/penelitianDosen', [PenelitianDosenController::class, 'index']);
            Route::post('/penelitianDosen', [PenelitianDosenController::class, 'store']);
            Route::get('/penelitianDosen/{penelitianDosen}', [PenelitianDosenController::class, 'show']);
            Route::put('/penelitianDosen/{penelitianDosen}', [PenelitianDosenController::class, 'update']);

            Route::get('/penelitianMahasiswa', [PenelitianMahasiswaController::class, 'index']);
            Route::post('/penelitianMahasiswa', [PenelitianMahasiswaController::class, 'store']);
            Route::get('/penelitianMahasiswa/{penelitianMahasiswa}', [PenelitianMahasiswaController::class, 'show']);
            Route::put('/penelitianMahasiswa/{penelitianMahasiswa}', [PenelitianMahasiswaController::class, 'update']);

            Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
            Route::post('/mahasiswa', [MahasiswaController::class, 'store']);
            Route::get('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'show']);
            Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update']);

            Route::get('/dosen', [DosenController::class, 'index']);
            Route::post('/dosen', [DosenController::class, 'store']);
            Route::get('/dosen/{dosen}', [DosenController::class, 'show']);
            Route::put('/dosen/{dosen}', [DosenController::class, 'update']);

            Route::get('/historyJabatan', [HistoryJabatanController::class, 'index']);
            Route::post('/historyJabatan', [HistoryJabatanController::class, 'store']);
            Route::get('/historyJabatan/{historyJabatan}', [HistoryJabatanController::class, 'show']);
            Route::put('/historyJabatan/{historyJabatan}', [HistoryJabatanController::class, 'update']);

            Route::get('/pengabdian', [PengabdianController::class, 'index']);
            Route::post('/pengabdian', [PengabdianController::class, 'store']);
            Route::get('/pengabdian/{pengabdian}', [PengabdianController::class, 'show']);
            Route::put('/pengabdian/{pengabdian}', [PengabdianController::class, 'update']);

            Route::get('/pengabdianDosen', [PengabdianDosenController::class, 'index']);
            Route::post('/pengabdianDosen', [PengabdianDosenController::class, 'store']);
            Route::get('/pengabdianDosen/{pengabdianDosen}', [PengabdianDosenController::class, 'show']);
            Route::put('/pengabdianDosen/{pengabdianDosen}', [PengabdianDosenController::class, 'update']);

            Route::get('/pengabdianMahasiswa', [PengabdianMahasiswaController::class, 'index']);
            Route::post('/pengabdianMahasiswa', [PengabdianMahasiswaController::class, 'store']);
            Route::get('/pengabdianMahasiswa/{pengabdianMahasiswa}', [PengabdianMahasiswaController::class, 'show']);
            Route::put('/pengabdianMahasiswa/{pengabdianMahasiswa}', [PengabdianMahasiswaController::class, 'update']);

            // Route::post('/register', [AuthController::class, 'register']);
        });

        Route::middleware('role:admin')->group(function () {
            Route::delete('/penelitian/{penelitian}', [PenelitianController::class, 'destroy']);
            Route::delete('/penelitianDosen/{penelitianDosen}', [PenelitianDosenController::class, 'destroy']);
            Route::delete('/penelitianMahasiswa/{penelitianMahasiswa}', [PenelitianMahasiswaController::class, 'destroy']);
            Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy']);
            Route::delete('/dosen/{dosen}', [DosenController::class, 'destroy']);
            Route::delete('/historyJabatan/{historyJabatan}', [HistoryJabatanController::class, 'destroy']);
            Route::delete('/pengabdian/{pengabdian}', [PengabdianController::class, 'destroy']);
            Route::delete('/pengabdianDosen/{pengabdianDosen}', [PengabdianDosenController::class, 'destroy']);
            Route::delete('/pengabdianMahasiswa/{pengabdianMahasiswa}', [PengabdianMahasiswaController::class, 'destroy']);
        });

        Route::post('/logout', [AuthController::class, 'logout']);
    });
    Route::post('/login', [AuthController::class, 'login']);
});