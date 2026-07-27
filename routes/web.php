<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Perfu.me
|--------------------------------------------------------------------------
*/

// Serve Main Public SPA Shell
Route::get('/', function () {
    return file_get_contents(public_path('index.html'));
});

// Serve Admin Portal Page
Route::get('/admin', function () {
    return file_get_contents(public_path('admin/index.html'));
});
