<?php

namespace HR\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isAdmin
{
    public function handle($request, Closure $next)
    {
        if(!Auth::check())
            abort('403');

        if(Auth::user()->hasRole('برنامه نویس'))
            return $next($request);

        if (Auth::user()->hasRole('سوپرادمین')) //If user does //not have this permission
            return $next($request);

        if (Auth::user()->hasPermissionTo('پنل ادمین')) //If user does //not have this permission
            return $next($request);


        abort('403');


    }
}
