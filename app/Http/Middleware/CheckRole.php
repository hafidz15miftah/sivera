<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if ($role == 'kepdes' && auth()->user()->role_id == 1){
            return $next($request);
        }

        if ($role == 'kup' && auth()->user()->role_id == 2){
            return $next($request);
        }

        if ($role == 'peminjam' && auth()->user()->role_id == 3){
            return $next($request);
        }

        abort(401);
        
    }
}
