<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes — Perfu.me
|--------------------------------------------------------------------------
*/

// ── Public Routes ────────────────────────────────────────────
Route::prefix('products')->group(function () {
    Route::get('/',         [ProductController::class, 'index']);
    Route::get('/stats',    [ProductController::class, 'stats']);
    Route::get('/{id}',     [ProductController::class, 'show']);
});

// ── Auth Routes ──────────────────────────────────────────────
Route::prefix('auth')->group(function () {
    Route::post('/login',   [AuthController::class, 'login']);
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::get('/check',    [AuthController::class, 'check']);
});

// ── Protected Admin Routes ───────────────────────────────────
Route::middleware('admin.token')->prefix('products')->group(function () {
    Route::post('/',               [ProductController::class, 'store']);
    Route::put('/{id}',            [ProductController::class, 'update']);
    Route::delete('/{id}',         [ProductController::class, 'destroy']);
    Route::patch('/{id}/zero-stock', [ProductController::class, 'zeroStock']);
});
