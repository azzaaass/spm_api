<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenelitianController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->group( function () {
    Route::middleware('auth:sanctum')->group(function () {
        // Route::get('/user', function (Request $request) {
        //     return $request->user();
        // });
    
        Route::post('/penelitian', [PenelitianController::class, 'store']);
        Route::get('/penelitian', [PenelitianController::class, 'index']);
        Route::get('/penelitian/{id}', [PenelitianController::class, 'show']);

        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::post('/login', [AuthController::class, 'login']);
    // Route::post('/register', [AuthController::class, 'register']);
});


