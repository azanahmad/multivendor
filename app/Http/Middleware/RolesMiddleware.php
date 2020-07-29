<?php

namespace App\Http\Middleware;

use Closure;

class RolesMiddleware
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

        $role = auth()->user()->roles()->pluck('role_id');

        if($role[0] =='1')
        {
            return $next($request);
        }
        else{
            return redirect()->route('dashboard');
        }

    }
}
