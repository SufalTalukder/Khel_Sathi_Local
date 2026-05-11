<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlineAdmissionTest
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('OnlineAdmission')->check()) {
            return $next($request);
        }
        return redirect('/onlineAdmission')->with('error', "You don't have access.");
    }
}
