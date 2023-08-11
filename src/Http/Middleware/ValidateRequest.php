<?php

namespace Statview\Satellite\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateRequest
{
    public function handle(Request $request, Closure $next)
    {
        abort_if(
            boolean: config('statview.strict') && ! $this->checkIp($request),
            code: 403
        );

        abort_unless(
            boolean: $request->bearerToken() === config('statview.api_key'),
            code: 403
        );

        return $next($request);
    }

    private function checkIp(Request $request): bool
    {
        $whitelistedIps = config('statview.whitelisted_ips');

        if (in_array($request->ip(), $whitelistedIps)) {
            return true;
        }

        if (in_array($request->ip(), config('statview.services.cloudflare_ips')) && in_array($request->header('CF-Connecting-IP'), $whitelistedIps)) {
            return true;
        }

        return false;
    }
}