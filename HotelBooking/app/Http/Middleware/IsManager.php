<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsManager
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
        if(Auth::check() && Auth::user()->isManager()==1 || Auth::user()->isManager()==2 )
        {
            return $next($request);
        }
        return redirect("/home");
    }
}
