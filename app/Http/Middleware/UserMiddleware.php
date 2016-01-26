<?php

namespace Koya\Http\Middleware;

use Closure;
use Auth;
use Koya\Repositories\UserRepository;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function handle($request, Closure $next)
    {
        if($this->user->getUserByUsername($request->route_username) == null) {
            abort(404);
        }
        return $next($request);
    }
}
