<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if ($role == 'sekdesadmin' && Auth::user()->role_id == 1 || $role == 'sekdesadmin' && Auth::user()->role_id == 5){
            return $next($request);
        }

        if ($role == 'kaurumumadminstaf' && Auth::user()->role_id == 2 || $role == 'kaurumumadminstaf' && Auth::user()->role_id == 4 || $role == 'kaurumumadminstaf' && Auth::user()->role_id == 5){
            return $next($request);
        }

        if ($role == 'kepdesadmin' && Auth::user()->role_id == 3 || $role == 'kepdesadmin' && Auth::user()->role_id == 5){
            return $next($request);
        }
        abort(401);
    }
}
