<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Auth;
class CheckLoginMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        
        if (Auth::check()) {

            return $next($request);
    }
    return redirect()->route('login')->with('error', 'Bạn chưa đăng nhập!');
}
}
