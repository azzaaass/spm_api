<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HistoryJabatanController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\PenelitianDosenController;
use App\Http\Controllers\PenelitianMahasiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        // Route::get('/user', function (Request $request) {
        //     return $request->user();
        // });

        Route::get('/penelitian', [PenelitianController::class, 'index']);
        Route::post('/penelitian', [PenelitianController::class, 'store']);
        Route::get('/penelitian/{penelitian}', [PenelitianController::class, 'show']);
        Route::delete('/penelitian/{penelitian}', [PenelitianController::class, 'destroy']);
        Route::put('/penelitian/{penelitian}', [PenelitianController::class, 'update']);

        Route::get('/penelitianDosen', [PenelitianDosenController::class, 'index']);
        Route::post('/penelitianDosen', [PenelitianDosenController::class, 'store']);
        Route::get('/penelitianDosen/{penelitianDosen}', [PenelitianDosenController::class, 'show']);
        Route::delete('/penelitianDosen/{penelitianDosen}', [PenelitianDosenController::class, 'destroy']);
        Route::put('/penelitianDosen/{penelitianDosen}', [PenelitianDosenController::class, 'update']);

        Route::get('/penelitianMahasiswa', [PenelitianMahasiswaController::class, 'index']);
        Route::post('/penelitianMahasiswa', [PenelitianMahasiswaController::class, 'store']);
        Route::get('/penelitianMahasiswa/{penelitianMahasiswa}', [PenelitianMahasiswaController::class, 'show']);
        Route::delete('/penelitianMahasiswa/{penelitianMahasiswa}', [PenelitianMahasiswaController::class, 'destroy']);
        Route::put('/penelitianMahasiswa/{penelitianMahasiswa}', [PenelitianMahasiswaController::class, 'update']);

        Route::get('/mahasiswa', [DosenController::class, 'index']);
        Route::post('/mahasiswa', [DosenController::class, 'store']);
        Route::get('/mahasiswa/{mahasiswa}', [DosenController::class, 'show']);
        Route::delete('/mahasiswa/{mahasiswa}', [DosenController::class, 'destroy']);
        Route::put('/mahasiswa/{mahasiswa}', [DosenController::class, 'update']);

        Route::get('/dosen', [DosenController::class, 'index']);
        Route::post('/dosen', [DosenController::class, 'store']);
        Route::get('/dosen/{dosen}', [DosenController::class, 'show']);
        Route::delete('/dosen/{dosen}', [DosenController::class, 'destroy']);
        Route::put('/dosen/{dosen}', [DosenController::class, 'update']);

        Route::get('/historyJabatan', [HistoryJabatanController::class, 'index']);
        Route::post('/historyJabatan', [HistoryJabatanController::class, 'store']);
        Route::get('/historyJabatan/{historyJabatan}', [HistoryJabatanController::class, 'show']);
        Route::delete('/historyJabatan/{historyJabatan}', [HistoryJabatanController::class, 'destroy']);
        Route::put('/historyJabatan/{historyJabatan}', [HistoryJabatanController::class, 'update']);

        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::post('/login', [AuthController::class, 'login']);
    // Route::post('/register', [AuthController::class, 'register']);
});