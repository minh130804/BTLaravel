<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; 


class CheckTimeAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $now = Carbon::now();
        $start = Carbon::parse("07:00:00");
        $end = Carbon::parse("20:00:00");
    //     if ($now -> between($start, $end)){
    //         return $next($request);
    //     } else{
    //       return response()->json([
    //     'message'=>'access denied',
    //     'time'=> $now->format('H:i:s'),
    //    ]);
    //     }
       

        return $next($request);
    }
}
