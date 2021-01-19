<?php

namespace HR\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isSuperAdmin
{

    public function handle($request, Closure $next)
    {
        if(!Auth::check())
            abort('401');

        if(Auth::user()->hasRole('برنامه نویس'))
            return $next($request);

        if (!Auth::user()->hasRole('سوپرادمین')) //If user does //not have this permission
        {
            abort('401');
        }
        return $next($request);
    }
}
