<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserLocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_locked) {
            Auth::logout();

            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'error' => __('messages.user_locked'),
                    'redirect' => route('home'),
                ], 403);
            }

            return redirect()->route('home')->with('error', __('messages.user_locked'));
        }

        return $next($request);
    }
}

