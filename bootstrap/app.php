<?php

use App\Http\Middleware\CheckUserLocked;
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
        $middleware->append(CheckUserLocked::class);
        $middleware->validateCsrfTokens(except: [
            '/nap-the-cao/callback-the'
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
