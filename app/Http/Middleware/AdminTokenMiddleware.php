<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class AdminTokenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token || !Cache::has('admin_token_' . $token)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Token tidak valid atau sudah kadaluarsa.',
            ], 401);
        }

        return $next($request);
    }
}
