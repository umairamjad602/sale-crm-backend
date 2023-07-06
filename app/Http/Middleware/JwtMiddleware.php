<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Http\Response as ResponseCode;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class JwtMiddleware extends BaseMiddleware
{
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function handle($request, Closure $next)
    {
        global $app;
        $currentPath = Route::getFacadeRoot()->current()->uri();
        if (Str::contains($currentPath, 'auth') ||
            Str::contains($currentPath, 'open') ||
            Str::contains($currentPath, 'public-data')) {
            return $next($request);
        }

        try {
            $app['user'] = $this->jwt->parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['error' => 'Authentication Token is Invalid', 'token_status' => 'token_invalid'], ResponseCode::HTTP_UNAUTHORIZED);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['error' => 'Authentication Token is Expired', 'token_status' => 'token_expired'], ResponseCode::HTTP_UNAUTHORIZED);
            } else {
                return response()->json(['error' => 'Authorization Token not found.', 'token_status' => 'token_not_found'], ResponseCode::HTTP_UNAUTHORIZED);
            }
        }
        return $next($request);
    }
}
