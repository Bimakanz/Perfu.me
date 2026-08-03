<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Perfu.me
|--------------------------------------------------------------------------
*/

// Storefront — Blade Views
Route::get('/', fn() => view('home'))->name('home');
Route::get('/katalog', fn() => view('katalog'))->name('katalog');
Route::get('/quiz', fn() => view('quiz'))->name('quiz');

// Admin Portal — Blade View
Route::get('/admin', fn() => view('admin.index'))->name('admin');
