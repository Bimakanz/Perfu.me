<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // ── GET /api/products ────────────────────────────────────
    public function index(Request $request)
    {
        $query = Product::query();

        // Filter: gender
        if ($request->filled('gender') && strtolower($request->gender) !== 'all') {
            $query->where('gender', $request->gender);
        }

        // Filter: variant
        if ($request->filled('variant') && strtolower($request->variant) !== 'all') {
            $query->where('variant', $request->variant);
        }

        // Filter: price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (int) $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', (int) $request->max_price);
        }

        // Search
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('variant', 'like', "%{$q}%")
                    ->orWhere('top_notes', 'like', "%{$q}%");
            });
        }

        // Filter: best_seller
        if ($request->boolean('best_seller')) {
            $query->where('best_seller', true);
        }

        $products = $query->orderBy('id')->get();

        return response()->json([
            'success' => true,
            'data'    => $products,
            'total'   => $products->count(),
        ]);
    }

    // ── GET /api/products/{id} ───────────────────────────────
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan.'], 404);
        }

        return response()->json(['success' => true, 'data' => $product]);
    }

    // ── POST /api/products ───────────────────────────────────
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'type'         => 'required|string|max:100',
            'gender'       => 'required|in:Pria,Wanita,Unisex',
            'variant'      => 'required|string|max:100',
            'top_notes'    => 'required|string',
            'middle_notes' => 'required|string',
            'base_notes'   => 'required|string',
            'packaging'    => 'required|string',
            'size'         => 'required|string|max:20',
            'price'        => 'required|integer|min:0',
            'stock'        => 'required|integer|min:0',
            'best_seller'  => 'boolean',
            'image'        => 'nullable|string',
            'description'  => 'nullable|string',
            'tagline'      => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $product = Product::create($validator->validated());

        return response()->json(['success' => true, 'data' => $product, 'message' => 'Produk berhasil ditambahkan.'], 201);
    }

    // ── PUT /api/products/{id} ───────────────────────────────
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan.'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'         => 'sometimes|string|max:255',
            'type'         => 'sometimes|string|max:100',
            'gender'       => 'sometimes|in:Pria,Wanita,Unisex',
            'variant'      => 'sometimes|string|max:100',
            'top_notes'    => 'sometimes|string',
            'middle_notes' => 'sometimes|string',
            'base_notes'   => 'sometimes|string',
            'packaging'    => 'sometimes|string',
            'size'         => 'sometimes|string|max:20',
            'price'        => 'sometimes|integer|min:0',
            'stock'        => 'sometimes|integer|min:0',
            'best_seller'  => 'sometimes|boolean',
            'image'        => 'nullable|string',
            'description'  => 'nullable|string',
            'tagline'      => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $product->update($validator->validated());

        return response()->json(['success' => true, 'data' => $product, 'message' => 'Produk berhasil diperbarui.']);
    }

    // ── DELETE /api/products/{id} ────────────────────────────
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan.'], 404);
        }

        $product->delete();

        return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus.']);
    }

    // ── PATCH /api/products/{id}/zero-stock ─────────────────
    public function zeroStock($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan.'], 404);
        }

        $product->update(['stock' => 0]);

        return response()->json(['success' => true, 'data' => $product, 'message' => 'Stok produk berhasil di-nol-kan.']);
    }

    // ── GET /api/stats ───────────────────────────────────────
    public function stats()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'total'        => Product::count(),
                'best_sellers' => Product::where('best_seller', true)->count(),
                'low_stock'    => Product::where('stock', '>', 0)->where('stock', '<', 20)->count(),
                'out_of_stock' => Product::where('stock', 0)->count(),
            ],
        ]);
    }
}
