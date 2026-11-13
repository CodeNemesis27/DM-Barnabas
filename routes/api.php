<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ChurchController;
use App\Http\Controllers\Api\V1\DashboardController;
use App\Http\Controllers\Api\V1\LookupController;
use App\Http\Controllers\Api\V1\MemberController;
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

        // Staff (Admin and Clerk) can read everything, and add or edit members (member intake).
        Route::middleware('api.role:Admin,Clerk')->group(function () {
            Route::get('dashboard', DashboardController::class);

            Route::get('lookups', [LookupController::class, 'index']);
            Route::get('lookups/available-users', [LookupController::class, 'availableUsers']);

            Route::get('churches', [ChurchController::class, 'index']);
            Route::get('churches/{church}', [ChurchController::class, 'show']);

            Route::get('members', [MemberController::class, 'index']);
            Route::get('members/{member}', [MemberController::class, 'show']);
            Route::post('members', [MemberController::class, 'store']);
            Route::put('members/{member}', [MemberController::class, 'update']);
        });

        // Only Admins can change churches or delete members.
        Route::middleware('api.role:Admin')->group(function () {
            Route::post('churches', [ChurchController::class, 'store']);
            Route::put('churches/{church}', [ChurchController::class, 'update']);
            Route::delete('churches/{church}', [ChurchController::class, 'destroy']);

            Route::delete('members/{member}', [MemberController::class, 'destroy']);
        });
    });
});
