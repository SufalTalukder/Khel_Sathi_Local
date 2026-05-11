<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class IsMapping
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
        // dd("hello");
        // $current_uri = (request()->segments())[1];
        $path = request()->path(); // e.g. "sport/admin/information/projects_under_construction"
        $current_uri = Str::after($path, 'admin/');
        $page_id = DB::table('urm_page_manager')->select('id')->where('page_url', 'LIKE', '%'.$current_uri.'%')->first();
        // dd(Auth::guard('admin')->user()->id); 
        if((Auth::guard('admin')->user() &&  DB::table('urm_role_module_mapping')->where('user_id', Auth::guard('admin')->user()->id)->where('page_id', $page_id->id)->exists()) || $current_uri  == 'dashboard'){
           
            return $next($request); 
        }
        return redirect('/admin/unauthorized')->with('error', "You don't have access.");
    }
}
