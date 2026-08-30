<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestimonialController;

/*
|--------------------------------------------------------------------------
| API Routes — Perfu.me
|--------------------------------------------------------------------------
*/

// ── Public Routes (Products) ─────────────────────────────────
Route::prefix('products')->group(function () {
    Route::get('/',         [ProductController::class, 'index']);
    Route::get('/stats',    [ProductController::class, 'stats']);
    Route::get('/{id}',     [ProductController::class, 'show']);
});

// ── Public Routes (Testimonials GET) ─────────────────────────
Route::get('/testimonials', [TestimonialController::class, 'index']);

// ── Auth Routes ──────────────────────────────────────────────
Route::prefix('auth')->group(function () {
    Route::post('/login',   [AuthController::class, 'login']);
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::get('/check',    [AuthController::class, 'check']);
});

// ── Protected Admin Routes (Products & Testimonials) ─────────
Route::middleware('admin.token')->group(function () {
    // Protected Products
    Route::prefix('products')->group(function () {
        Route::post('/',                [ProductController::class, 'store']);
        Route::put('/{id}',             [ProductController::class, 'update']);
        Route::delete('/{id}',          [ProductController::class, 'destroy']);
        Route::patch('/{id}/zero-stock',[ProductController::class, 'zeroStock']);
    });

    // Protected Testimonials (Create & Delete)
    Route::prefix('testimonials')->group(function () {
        Route::post('/',        [TestimonialController::class, 'store']);
        Route::delete('/{id}',  [TestimonialController::class, 'destroy']);
    });
});