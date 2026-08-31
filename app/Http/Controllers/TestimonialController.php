<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    // GET /api/testimonials
    public function index()
    {
        $testimonials = Testimonial::with('product')->latest()->get();
        return response()->json(['success' => true, 'data' => $testimonials]);
    }

    // POST /api/testimonials
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required|string|max:255',
            'text'       => 'required|string',
            'rating'     => 'required|integer|min:1|max:5',
            'product_id' => 'nullable|exists:products,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $testimonial = Testimonial::create($validator->validated());

        return response()->json([
            'success' => true, 
            'data'    => $testimonial, 
            'message' => 'Testimoni berhasil ditambahkan.'
        ], 201);
    }

    // DELETE /api/testimonials/{id}
    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) {
            return response()->json(['success' => false, 'message' => 'Testimoni tidak ditemukan.'], 404);
        }

        $testimonial->delete();
        return response()->json(['success' => true, 'message' => 'Testimoni berhasil dihapus.']);
    }
}