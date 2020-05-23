<?php

namespace App\Http\Middleware;

use Closure;

class CheckSubscriptionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            if(auth()->check()){
                if (auth()->user() && !(auth()->user()->subscribed('price_HHscK4hA3OppYy') || auth()->user()->subscribed('price_HHseeeuTgOe3DY'))) {
                    // This user is not a paying customer...
                    return $next($request);
                }
            }

        return redirect('/');
    }
}
