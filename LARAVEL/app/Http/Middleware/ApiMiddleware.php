<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Log;
use Closure;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class ApiMiddleware
{
    public function handle(Request $request, Closure $next)
{
    $token = $request->bearerToken();
    Log::info('Received token: ' . ($token ?? 'null'));

    if (!$token) {
        Log::warning('Token tidak ditemukan');
        return response()->json(['message' => 'Token tidak ditemukan'], 401);
    }

    $accessToken = PersonalAccessToken::findToken($token);
    Log::info('AccessToken object:', ['accessToken' => $accessToken]);

    if (!$accessToken) {
        Log::warning('Access token tidak ditemukan di database');
        return response()->json(['message' => 'Token tidak valid'], 401);
    }

    if ($accessToken->tokenable_type !== Siswa::class) {
        Log::warning('Tokenable type tidak sesuai', ['expected' => Siswa::class, 'actual' => $accessToken->tokenable_type]);
        return response()->json(['message' => 'Token tidak valid'], 401);
    }

    $request->setUserResolver(fn() => $accessToken->tokenable);

    return $next($request);
}
}

