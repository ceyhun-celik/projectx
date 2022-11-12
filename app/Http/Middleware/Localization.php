<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Localization
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        # Set language session if not exists
        if(! Session::has('language')){
            Session::put('language', Auth::user()->authorization->language);
        }

        # Set language session in app locale
        App::setLocale(Session::get('language'));

        return $next($request);
    }
}
