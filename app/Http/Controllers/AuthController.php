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

        $ip = $request->ip();
        $attemptsKey = 'login_attempts_' . $ip;
        $lockoutKey  = 'login_lockout_' . $ip;

        // Check if currently locked out
        if (Cache::has($lockoutKey)) {
            $secondsRemaining = Cache::get($lockoutKey) - time();
            if ($secondsRemaining > 0) {
                $minutes = ceil($secondsRemaining / 60);
                return response()->json([
                    'success' => false,
                    'message' => "Terlalu banyak percobaan gagal. Silakan coba lagi dalam {$secondsRemaining} detik ({$minutes} menit).",
                    'retry_after' => $secondsRemaining,
                    'locked' => true,
                ], 429);
            } else {
                Cache::forget($lockoutKey);
                Cache::forget($attemptsKey);
            }
        }

        $validUser = hash_equals((string) config('admin.username'), (string) $request->username);
        $validPass = hash_equals((string) config('admin.password'), (string) $request->password);

        if (!$validUser || !$validPass) {
            $attempts = (int) Cache::get($attemptsKey, 0) + 1;
            
            if ($attempts >= 3) {
                $lockoutUntil = time() + 180; // 3 minutes = 180 seconds
                Cache::put($lockoutKey, $lockoutUntil, 180);
                Cache::forget($attemptsKey);

                return response()->json([
                    'success' => false,
                    'message' => 'Anda telah 3 kali salah memasukkan password. Akun terkunci selama 3 menit.',
                    'retry_after' => 180,
                    'locked' => true,
                ], 429);
            }

            Cache::put($attemptsKey, $attempts, 180);
            $remaining = 3 - $attempts;

            return response()->json([
                'success' => false,
                'message' => "Username atau password salah. sisa percobaan: {$remaining}x lagi.",
                'remaining_attempts' => $remaining,
            ], 401);
        }

        // Login success: Clear failed attempts
        Cache::forget($attemptsKey);
        Cache::forget($lockoutKey);

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
