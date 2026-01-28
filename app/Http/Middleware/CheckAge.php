<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class CheckAge
{
    public function handle(Request $request, Closure $next): Response
    {
        
        $age = Session::get('age');

        
        if (is_numeric($age) && $age >= 18) {
         
            return $next($request);
        }

       
        return new Response("Không được phép truy cập", 403);
    }
}