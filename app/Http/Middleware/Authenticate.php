<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('authenticated')) {
            return redirect('/login')->with('loginError', 'You must be logged in to access this page.');
        }

        return $next($request);
    }
}
