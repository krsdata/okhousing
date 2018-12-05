<?php

namespace Modules\Countries\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use App;
use Config;
class LaguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session::has('fcountry') && Session::has('locale') )
        {
            $locale=Session::get('locale',Config::get('app.locale')); 
        }else
        {
           $locale='en'; 
        }
        App::setLocale($locale);
        return $next($request);
    }
}
