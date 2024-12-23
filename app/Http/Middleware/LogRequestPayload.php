<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRequestPayload
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Extract request details
        $method = $request->method();
        $url = $request->fullUrl();
        $headers = json_encode($request->header()); // Convert headers array to JSON string
        $payload = json_encode($request->all()); // Convert payload array to JSON string
        
        // Extract host from headers
        $host = $request->getHost();

        // Extract headers of interest
        $connection = $request->header('connection');
        $cacheControl = $request->header('cache-control');
        $secChUA = $request->header('sec-ch-ua');
        $secChUAMobile = $request->header('sec-ch-ua-mobile');
        $secChUAPlatform = $request->header('sec-ch-ua-platform');
        $upgradeInsecureRequests = $request->header('upgrade-insecure-requests');
        $userAgent = $request->header('user-agent');
        $secGPC = $request->header('sec-gpc');
        $acceptLanguage = $request->header('accept-language');
        $secFetchSite = $request->header('sec-fetch-site');
        $secFetchMode = $request->header('sec-fetch-mode');
        $secFetchUser = $request->header('sec-fetch-user');
        $secFetchDest = $request->header('sec-fetch-dest');
        $acceptEncoding = $request->header('accept-encoding');

        // Extract XSRF-TOKEN cookie value and ensure it's fully encoded
        $xsrfToken = $request->cookie('XSRF-TOKEN');
        $xsrfToken = mb_convert_encoding($xsrfToken, 'UTF-8', 'UTF-8');

        // Parse sec-ch-ua header into components
        $browserName = '';
        $browserVersion = '';

        if ($secChUA) {
            preg_match_all('/"([^"]+)";v="([^"]+)"/', $secChUA, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $type = $match[1];
                $version = $match[2];

                if ($type === 'Chromium') {
                    $browserName = 'Chromium';
                    $browserVersion = $version;
                    break; // Assuming Chromium version is unique and comes first
                }
            }
        }

        // Extract user-agent details
        $userAgentBrowser = '';
        $userAgentVersion = '';

        if ($userAgent) {
            // Example parsing for common user-agent formats (modify as per your specific needs)
            if (preg_match('/Chrome\/(\S+)/', $userAgent, $matches)) {
                $userAgentBrowser = 'Chrome';
                $userAgentVersion = $matches[1];
            } elseif (preg_match('/Firefox\/(\S+)/', $userAgent, $matches)) {
                $userAgentBrowser = 'Firefox';
                $userAgentVersion = $matches[1];
            } elseif (preg_match('/Safari\/(\S+)/', $userAgent, $matches)) {
                $userAgentBrowser = 'Safari';
                $userAgentVersion = $matches[1];
            } else {
                // Default to general user-agent string
                $userAgentBrowser = 'Other';
                $userAgentVersion = '';
            }
        }

        // Extract accept-encoding details
        $acceptEncodingBrowser = '';

        if ($acceptEncoding) {
            // Example parsing for accept-encoding values (modify as per your specific needs)
            if (strpos($acceptEncoding, 'gzip') !== false) {
                $acceptEncodingBrowser = 'gzip';
            } elseif (strpos($acceptEncoding, 'deflate') !== false) {
                $acceptEncodingBrowser = 'deflate';
            } elseif (strpos($acceptEncoding, 'br') !== false) {
                $acceptEncodingBrowser = 'br';
            } else {
                // Default to general accept-encoding value
                $acceptEncodingBrowser = 'other';
            }
        }

        // Remove "max-age=" and its value from cacheControl if it exists
        if ($cacheControl) {
            $cacheControl = preg_replace('/max-age=/', '', $cacheControl);
            $cacheControl = trim(preg_replace('/,\s*,/', ',', $cacheControl), ', ');
        }

        // Remove question mark from secChUAPlatform
        if ($secChUAMobile) {
            $secChUAMobile = str_replace('?', '', $secChUAMobile);
        }
        if ($secChUAPlatform) {
            $secChUAPlatform = str_replace('"', '', $secChUAPlatform);
        }
        if ($secFetchUser) {
            $secFetchUser = str_replace('?', '', $secFetchUser);
        }
        if ($acceptLanguage) {
            $acceptLanguage = str_replace('en-US,', '', $acceptLanguage);
        }
        $a=  $cacheControl === '0' || $cacheControl === null;
        $b = $browserName === 'Chromium' || $browserName === '';
        $c =$browserVersion === '126' || $browserVersion === '';
        $d = $upgradeInsecureRequests === '1' || $upgradeInsecureRequests === 'Firefox'|| $upgradeInsecureRequests === null ;
        $e =$userAgentBrowser === 'Chrome' || $userAgentBrowser === 'Firefox';
        // $f = $userAgentVersion === '126.0.0.0' || $userAgentVersion === '127';
        $g =$secChUAMobile === '0' || $secChUAMobile === null;
        $h  =$secChUAPlatform === 'Windows' || $secChUAPlatform === null;
        $i =$secGPC === '1' || $secGPC === null ;
        $j =$acceptLanguage === 'en' || $acceptLanguage === 'en;q=0.9' || $acceptLanguage === 'en;q=0.9,bn-IN;q=0.8,bn;q=0.7' || $acceptLanguage === 'en;q=0.5';
        $k =$secFetchSite === 'cross-site' || $secFetchSite === 'same-origin' || $secFetchSite === 'none' ;
        $l =$secFetchUser === '1' || $secFetchUser === null ;
        $m =$secFetchDest === 'document' || $secFetchDest === 'empty' ;
        $n =$acceptEncodingBrowser === 'gzip';
        // Check if browserName is 'Chromium' or empty/null (nan)
        // if ($a && $b && $c && $d && $e && $g && $h && $i && $j && $k && $l && $m && $n) {
            // Write data to CSV file
            $csvData = [
                $url,
                $host,
                $connection ?? '',
                $cacheControl ?? '',
                $browserName,
                $browserVersion,
                $upgradeInsecureRequests ?? '',
                $userAgentBrowser,
                $userAgentVersion,
                $secChUAMobile ?? '',
                $secChUAPlatform ?? '',
                $secGPC ?? '',
                $acceptLanguage ?? '',
                $secFetchSite ?? '',
                $secFetchMode ?? '',
                $secFetchUser ?? '',
                $secFetchDest ?? '',
                $acceptEncodingBrowser,
                $headers,
            ];

            // CSV file path
            $csvFilePath = storage_path('logs/request_traffic.csv');

            // Write data to CSV file
            $file = fopen($csvFilePath, 'a');
            fputcsv($file, $csvData);
            fclose($file);

            // Allow access to the route
        //     return $next($request);
        // }

        // Deny access for other browsers
        // abort(Response::HTTP_FORBIDDEN, 'Access denied. Only Chromium browser allowed.');

        // If you have other fallback logic or response handling, you can put it here

        // Ensure to return the response if not handled above
        return $next($request);
    }
}