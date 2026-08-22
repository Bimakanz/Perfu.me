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

// Sitemap — Dynamic XML
Route::get('/sitemap.xml', function () {
    $baseUrl = url('/');
    $products = \App\Models\Product::select('id', 'updated_at')->get();

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

    // Static Pages
    $xml .= "  <url>\n    <loc>{$baseUrl}</loc>\n    <changefreq>weekly</changefreq>\n    <priority>1.0</priority>\n  </url>\n";
    $xml .= "  <url>\n    <loc>{$baseUrl}/katalog</loc>\n    <changefreq>weekly</changefreq>\n    <priority>0.9</priority>\n  </url>\n";
    $xml .= "  <url>\n    <loc>{$baseUrl}/quiz</loc>\n    <changefreq>monthly</changefreq>\n    <priority>0.7</priority>\n  </url>\n";

    // Product Pages
    foreach ($products as $product) {
        $lastmod = $product->updated_at ? $product->updated_at->toAtomString() : now()->toAtomString();
        $xml .= "  <url>\n    <loc>{$baseUrl}/produk/{$product->id}</loc>\n    <lastmod>{$lastmod}</lastmod>\n    <changefreq>monthly</changefreq>\n    <priority>0.8</priority>\n  </url>\n";
    }

    $xml .= '</urlset>';

    return response($xml, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

