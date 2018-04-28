<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

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
        $language = Session::get('website_language', config('app.locale'));
        config(['app.locale' => $language]);
        
        return $next($request);
    }
}
