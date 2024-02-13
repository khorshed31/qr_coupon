<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Module\Permission\Models\Permission;
use Module\Permission\Models\PermissionUser;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $route = $request->route()->getName();


        if (auth()->id() != 1) {
            return $next($request);
        }

        return $next($request);
    }
}
