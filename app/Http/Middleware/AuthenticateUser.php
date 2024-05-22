<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // If the user is not authenticated, redirect them to the login page
            return redirect()->route('auth.login');
        }

        // If the user is authenticated, proceed with the request
        return $next($request);
    }
}
