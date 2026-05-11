<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class GymnasiumSwimming
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
        if (Auth::guard('GymnasiumSwimming')->check()) {
            return $next($request);
    } 
     return redirect()->route('gymnasium_swimming_login')->with('error', "You don't have access.");
    }
}
