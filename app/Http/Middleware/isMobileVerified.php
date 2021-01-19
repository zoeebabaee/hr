<?php

namespace HR\Http\Middleware;

use Closure;
use Auth;

class isMobileVerified
{
    public function handle($request, Closure $next)
    {
        if(!Auth::check())
            abort('401');
        if(Auth::user()->is_mobile_verified != 1)
            return redirect(route('register.confirm.mobile'))
                ->with('flash_message','جهت ادامه باید موبایل خود را تایید کنید');
        else
            return $next($request);
    }
}
