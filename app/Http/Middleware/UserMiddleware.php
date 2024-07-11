<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role == 'user') {
            return $next($request);
        }
        return redirect('/');
    }
}
