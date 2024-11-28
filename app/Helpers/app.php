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

if (!function_exists('isHomePage')) {
    /**
     * @return bool
     */
    function isHomePage()
    {
        $current = Route::current();
        if (!$current) {
            return false;
        }

        return $current->getName() === 'home';
    }
}

if (!function_exists('getPrice')) {
    /**
     * @return string
     */
    function getPrice($price)
    {
        try {

            if ($price === 0) {
                return 0;
            }

            return number_format($price, 0, ',', '.');
        } catch (Exception $e) {
            return '';
        }
    }
}
