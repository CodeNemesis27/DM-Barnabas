<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ChurchController;
use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\LookupController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Mobile app API (v1)
|--------------------------------------------------------------------------
| Laravel prefixes everything in this file with /api, so these are served at
| /api/v1/... The mobile app authenticates with Sanctum personal access tokens.
*/

Route::prefix('v1')->group(function () {
    Route::post('auth/login', [AuthController::class, 'login'])
        ->middleware('throttle:api-login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('auth/me', [AuthController::class, 'me']);
        Route::post('auth/logout', [AuthController::class, 'logout']);

        // Staff (Admin and Clerk) can read.
        Route::middleware('api.role:Admin,Clerk')->group(function () {
            Route::get('dashboard', DashboardController::class);
            Route::get('lookups', LookupController::class);
            Route::get('churches', [ChurchController::class, 'index']);
            Route::get('churches/{church}', [ChurchController::class, 'show']);
        });

        // Only Admins can change churches.
        Route::middleware('api.role:Admin')->group(function () {
            Route::post('churches', [ChurchController::class, 'store']);
            Route::put('churches/{church}', [ChurchController::class, 'update']);
            Route::delete('churches/{church}', [ChurchController::class, 'destroy']);
        });
    });
});
