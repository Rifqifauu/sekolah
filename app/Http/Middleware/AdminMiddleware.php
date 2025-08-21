<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
{
    if (Auth::check() && in_array(Auth::user()->role, ['admin', 'super_admin','user', 'pustakawan'])) {
        return $next($request);
    }
    return redirect('/home')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
}

}
