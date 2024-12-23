<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InspectUserAgent
{
    /**
     * List of blacklisted User-Agents.
     *
     * @var array
     */
    protected $badUserAgents = [
        'BadBot',    // Example user agents
        'EvilScraper',
        'MaliciousCrawler',
        'DotBot',
        'Baiduspider',
        'AhrefsBot',
        'SemrushBot',
        'MJ12bot',
        // Add more known bad user agents
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = $request->header('User-Agent');

        foreach ($this->badUserAgents as $badUserAgent) {
            if (stripos($userAgent, $badUserAgent) !== false) {
                return response('Forbidden', 403);
            }
        }

        return $next($request);
    }
}
