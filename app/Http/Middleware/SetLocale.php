<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // Handle method is triggered on every request
    public function handle($request, Closure $next)
    {
        // Check the session for a 'locale' value, or default to the app's default locale
        $locale = Session::get('locale', config('app.locale'));
        
        // Set the application's locale to the chosen one
        App::setLocale($locale);

        // Continue to the next part of the request lifecycle
        return $next($request);
    }
}
