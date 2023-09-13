<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsActive
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
        if ((int)auth()->user()->isActive === 1) {
            return $next($request);
        } else {
            //dd('oklm');
            //return route('products');
            abort(403);
        }

        // if(env('SUBSCRIPTION') === 'PREMIUM'){
        //     return $next($request);
        // }else{
        //     abort(403);
        // }
    }
}