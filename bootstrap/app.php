<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias ([
            'is_admin' => \App\Http\Middleware\IsAdmin::class,
            'customThrottle' => \App\Http\Middleware\CustomThrottle::class,
            'blockIP' => \App\Http\Middleware\BlockMaliciousIP::class,
            'inspectUserAgent' => \App\Http\Middleware\InspectUserAgent::class,
            'blockGeolocation' => \App\Http\Middleware\BlockGeolocation::class,
            'log.payload' => \App\Http\Middleware\LogRequestPayload::class,



            
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        ]);
        $middleware->web(append: [
            \App\Http\Middleware\BlockMaliciousIP::class,
            \App\Http\Middleware\InspectUserAgent::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \App\Http\Middleware\LogRequestPayload::class,


            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
        $middleware->api(append: [
             // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
             \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
             \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
