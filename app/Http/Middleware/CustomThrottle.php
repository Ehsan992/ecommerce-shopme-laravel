<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class CustomThrottle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = $this->resolveRequestSignature($request);
        $maxAttempts = 60;
        $decayMinutes = 1;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return $this->buildResponse($key, $maxAttempts);
        }

        RateLimiter::hit($key, $decayMinutes * 60);

        $response = $next($request);

        return $this->addHeaders(
            $response,
            $maxAttempts,
            RateLimiter::remaining($key, $maxAttempts),
            $key
        );
    }

    protected function resolveRequestSignature(Request $request)
    {
        return sha1($request->ip());
    }

    protected function buildResponse($key, $maxAttempts)
    {
        $response = response('Too many requests. Please slow down.', 429);

        return $this->addHeaders(
            $response,
            $maxAttempts,
            RateLimiter::remaining($key, $maxAttempts),
            $key
        );
    }

    protected function addHeaders(Response $response, $maxAttempts, $remainingAttempts, $key)
    {
        $retryAfter = RateLimiter::availableIn($key);

        return $response->withHeaders([
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => $remainingAttempts,
            'Retry-After' => $retryAfter,
        ]);
    }
}
