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
Route::get('/produk/{id}', function ($id) {
    $product = \App\Models\Product::find($id);
    if (!$product) abort(404);
    
    // Fetch 4 related/other products
    $relatedProducts = \App\Models\Product::where('id', '!=', $id)
        ->inRandomOrder()
        ->take(4)
        ->get();

    return view('product-detail', compact('product', 'relatedProducts'));
})->name('product.detail');

// Admin Portal — Blade View
Route::get('/admin', fn() => view('admin.index'))->name('admin');
