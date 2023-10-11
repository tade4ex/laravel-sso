<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class OAuth2Authenticated
{

    public function handle(Request $request, Closure $next): Response
    {
        if (now() < $request->session()->get('expire_at')) {
            return $next($request);
        }

        Auth::logout();

        return $next($request);
    }
}
