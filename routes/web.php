<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Testimonial;

/*
|--------------------------------------------------------------------------
| Web Routes — Perfu.me
|--------------------------------------------------------------------------
*/

// Storefront — Blade Views
Route::get('/', function () {
    // Ambil 8 testimoni terbaru beserta relasi produknya
    $testimonials = Testimonial::with('product')->latest()->take(8)->get();

    // Pecah menjadi 2 bagian untuk baris atas dan baris bawah pada slider
    $half = ceil($testimonials->count() / 2);
    $testimonialsTop = $testimonials->slice(0, $half);
    $testimonialsBottom = $testimonials->slice($half);

    return view('home', compact('testimonialsTop', 'testimonialsBottom'));
})->name('home');

Route::get('/katalog', fn() => view('katalog'))->name('katalog');
Route::get('/quiz', fn() => view('quiz'))->name('quiz');

Route::get('/produk/{id}', function ($id) {
    $product = Product::find($id);
    if (!$product) abort(404);
    
    // Fetch 4 related/other products
    $relatedProducts = Product::where('id', '!=', $id)
        ->inRandomOrder()
        ->take(4)
        ->get();

    return view('product-detail', compact('product', 'relatedProducts'));
})->name('product.detail');

// Admin Portal — Blade Views
Route::get('/admin', fn() => view('admin.index'))->name('admin');

Route::get('/admin/testimoni', function () {
    // Ambil data produk untuk dropdown pilihan di form tambah testimoni
    $products = Product::select('id', 'name')->orderBy('name')->get();
    
    // Ambil data testimoni agar tampil di daftar sebelah kanan
    $testimonials = Testimonial::with('product')->latest()->get();

    return view('admin.testimoni', compact('products', 'testimonials'));
})->name('admin.testimoni');

Route::get('/admin/produk/{id}', function ($id) {
    $product = Product::find($id);
    if (!$product) abort(404);

    $relatedProducts = Product::where('id', '!=', $id)
        ->inRandomOrder()
        ->take(4)
        ->get();

    return view('admin.product-detail', compact('product', 'relatedProducts'));
})->name('admin.product.detail');


// Sitemap — Dynamic XML
Route::get('/sitemap.xml', function () {
    $baseUrl = url('/');
    $products = Product::select('id', 'updated_at')->get();

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