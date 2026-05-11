<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StopScriptTags
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
        $input = $request->all();
        array_walk_recursive($input, function (&$input) {
            if (is_string($input)) {
                // Remove HTML tags but KEEP special characters to avoid breaking multi-byte encoding
                $input = strip_tags($input);
                
                // Only remove truly dangerous script-injection patterns if necessary, 
                // but avoid the blanket character deletion used previously.
                // Standard Laravel practice is to use e() or blade {{ }} for display.
            }
        });

        $request->merge($input);
        return $next($request);
    }

}
