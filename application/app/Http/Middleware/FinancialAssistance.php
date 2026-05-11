<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class FinancialAssistance
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
        // if(Auth::user() && Auth::user()->role !="dr")
        if(Auth::user() && DB::table('sport_welfare_registration_master')->join("sport_welfare_user_type_master","sport_welfare_registration_master.id","=","sport_welfare_user_type_master.user_id")->where('sport_welfare_user_type_master.registered_for', "FINANCIAL")->where('sport_welfare_registration_master.id', Auth::user()->id)->exists())
        {
            // dd(DB::table('sport_welfare_registration_master')->join("sport_welfare_user_type_master","sport_welfare_registration_master.id","=","sport_welfare_user_type_master.user_id")->where('sport_welfare_user_type_master.registered_for', "FINANCIAL")->where('sport_welfare_registration_master.id', Auth::user()->id)->exists());
            return $next($request);                        
        } 
        return redirect('/financial-assistance')->with('error', "You don't have access.");    
    }
}
