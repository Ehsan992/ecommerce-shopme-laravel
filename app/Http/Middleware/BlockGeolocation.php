<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class BlockGeolocation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the IP address of the incoming request
        $ip = $request->ip();
        
        // Get geolocation information for the IP
        $position = Location::get($ip);
        
        // Define the country code you want to block (e.g., 'CN' for China)
        $blockedCountryCode = 'CN';
        // Define the country codes you want to block (e.g., 'CN' for China, 'IN' for India)
        // $blockedCountryCodes = ['CN', 'IN'];
        // Check if the request is from the blocked country
        if ($position && $position->countryCode === $blockedCountryCode) {
            // If it's from the blocked country, return a 403 Forbidden response
            return response('Forbidden', 403);
        }
        
        // If the request is not from the blocked country, continue to the next middleware
        return $next($request);
    }
}
