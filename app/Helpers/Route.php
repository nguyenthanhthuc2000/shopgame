<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('isCurrentRoute')) {
    /**
     * Check current page ny route name
     * @param string $route
     * @return bool
     */
    function isCurrentRoute($route)
    {
        $current = Route::current();
        if (!$current) {
            return false;
        }

        return $current->getName() === $route;
    }
}
