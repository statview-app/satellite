<?php

namespace Statview\Satellite\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateRequest
{
    public function handle(Request $request, Closure $next)
    {
        abort_unless(
            boolean: $request->bearerToken() === config('statview.api_key'),
            code: 403
        );

        return $next($request);
    }
}