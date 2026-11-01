<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChurchController;
use Illuminate\Support\Facades\Route;

// 6 attempts per minute per IP/email slows down password guessing.
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:6,1');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/churches', [ChurchController::class, 'index']);
});
