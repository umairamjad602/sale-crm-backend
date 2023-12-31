<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Cros
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request)
        ->header('Access-Control-Allow-Origin', "*")
        ->header('Access-Control-Allow-Methods', "PUT, POST, GET, DELETE, OPTIONS")
        ->header('Access-Control-Allow-Headers', "Accept", "Authorization", "Content-Type")
        ->header('paths', "*");
    }
}
