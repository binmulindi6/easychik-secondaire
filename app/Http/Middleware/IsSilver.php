<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsSilver
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

        if (env('SUBSCRIPTION') === 'SILVER' || env('SUBSCRIPTION') === 'GOLD' || env('SUBSCRIPTION') === 'GOLD PREMIUM') {
            return $next($request);
        } else {
            abort(450);
        }
    }
}