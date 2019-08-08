<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Closure;

class Locale
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
        if ( Session::has('lang')) {
            App::setLocale(Session::get('lang'));
        }
        return $next($request);
    }
}
