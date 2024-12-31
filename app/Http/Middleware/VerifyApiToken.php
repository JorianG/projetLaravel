<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ApiToken;

class VerifyApiToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('X-API-Token');

        if (!$token) {
            return response()->json(['error' => 'API token is missing'], 401);
        }

        \Log::info('Received API token: ' . $token);

        $validToken = ApiToken::where('token', $token)
            ->where('active', true)
            ->first();

        if (!$validToken) {
            \Log::warning('Invalid API token: ' . $token);
            return response()->json(['error' => 'Invalid API token'], 401);
        }

        \Log::info('API Token: ' . $token);

        return $next($request);
    }
} 