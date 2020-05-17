<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DenyIfBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->guard("api")->check() && auth()->guard("api")->user()->blocked)
            abort(Response::HTTP_FORBIDDEN, trans("messages.blocked"));
        return $next($request);
    }
}
