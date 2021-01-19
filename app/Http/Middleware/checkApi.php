<?php

namespace HR\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class checkApi
{
    private $tokens = [
        'g$#%YHTNBR35refdv23rf' // test
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (
            !is_null($request->header('token')) &&
            !empty($request->header('token')) &&
            in_array($request->header('token'),
                $this->tokens)
        )
            return $next($request);

        abort(403);
    }
}
