<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class accountant_mid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->user_level ==1 || auth()->user()->user_level ==2)
        {
            return $next($request);
        }

        return response()->json(['msg'=>'عفوا ليس لديك صلاحية الدخول الى هذا القسم',403]);

    }
}
