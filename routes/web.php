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

// Admin Portal (static HTML)
Route::get('/admin', function () {
    return file_get_contents(public_path('admin/index.html'));
});
