<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockMaliciousIP
{
    /**
     * List of blacklisted IPs.
     *
     * @var array
     */
    protected $blacklist = [
        '123.123.123.123', // Example IPs
        '111.111.111.111',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (in_array($request->ip(), $this->blacklist)) {
            return response('Forbidden', 403);
        }

        return $next($request);
    }
}
