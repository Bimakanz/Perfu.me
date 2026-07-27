<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    // ── POST /api/auth/login ─────────────────────────────────
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $validUser = $request->username === config('admin.username');
        $validPass = $request->password === config('admin.password');

        if (!$validUser || !$validPass) {
            return response()->json([
                'success' => false,
                'message' => 'Username atau password salah.',
            ], 401);
        }

        // Generate a simple token and cache it for 8 hours
        $token = Str::random(64);
        Cache::put('admin_token_' . $token, true, now()->addHours(8));

        return response()->json([
            'success' => true,
            'token'   => $token,
            'message' => 'Login berhasil.',
        ]);
    }

    // ── POST /api/auth/logout ────────────────────────────────
    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        if ($token) {
            Cache::forget('admin_token_' . $token);
        }

        return response()->json(['success' => true, 'message' => 'Logout berhasil.']);
    }

    // ── GET /api/auth/check ──────────────────────────────────
    public function check(Request $request)
    {
        $token = $request->bearerToken();
        $valid = $token && Cache::has('admin_token_' . $token);

        return response()->json(['success' => $valid, 'authenticated' => $valid]);
    }
}
