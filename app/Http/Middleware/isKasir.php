<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isKasir
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // only allow loggedin user with role admin 
        if (auth()->check() && (auth()->user()->role == "admin" || auth()->user()->role == "kasir")) {
            return $next($request);
        }
        abort(403, "You don't have permission to access this page");
    }
}
