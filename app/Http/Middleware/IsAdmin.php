<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if(!auth()->user()->admin()){
            return response(['errors' => (Object) ['error' => ['You have no rights to perform this action']]], 422);
        }
        return $next($request);
    }
}
