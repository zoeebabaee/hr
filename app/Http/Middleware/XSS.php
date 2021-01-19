<?php

namespace HR\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class XSS
{
    public function handle(Request $request, Closure $next)
    {
        $in = $request->all();

        if(strpos($in , '>'))
return back();
        if(strpos($in , '<'))
return back();

        else
            return $next();
    }
}