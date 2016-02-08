<?php

namespace Koya\Http\Middleware;

use Auth;
use Closure;

class LoggedInUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        return $next($request);
    }
}
