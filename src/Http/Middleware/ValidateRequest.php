<?php

namespace Statview\Satellite\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateRequest
{
    public function handle(Request $request, Closure $next)
    {
        abort_if(
            boolean: config('statview.strict') && ! in_array($request->ip(), config('statview.whitelisted_ips')),
            code: 403
        );

        abort_unless(
            boolean: $request->bearerToken() === config('statview.api_key'),
            code: 403
        );

        return $next($request);
    }
}